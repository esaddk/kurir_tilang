<?php

namespace App\Http\Controllers;

use File;
use App\User;
use App\kurir;
use App\order;
use Notification;
use Carbon\Carbon;
use App\pengiriman;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use App\Notifications\NeedPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\OrderOnprogress;
use App\Notifications\KonfirmasiKurir;
use App\Notifications\OrderComplete;

class OrderController extends Controller
{    

    public function CreateOrder()
    {
        // Alert::message('Thanks for comment!')->persistent('Close');
        Alert::warning('Mohon Membaca Syarat dan Ketentuan', '')->persistent('Close');
        return view('order.create');
    }

    public function GenerateKodeOrder()
    {
        $now = Carbon::now();
        $unique_code = $now->format('YmdH');
        $order = order::orderBy('id', 'DESC');
        if ($order->count() > 0) {
            $order = $order->first();
            // $explode = explode('-', $order->kode_order);
            $explode = $order->id;
            $count = $explode + 1;
            return 'KT-'. $unique_code . $count;
        }
        return 'KT-'.$unique_code.'1';
    }

    public function sendSMS()
    {
        Nexmo::message()->send([
            'to'   => '+6282242711989',
            'from' => '16105552344',
            'text' => 'Salam hangat dari Kurir Tilang :D'
        ]);
    }

    private function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/foto_surat');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }

    private function saveFileTransfer($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/foto_transfer');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
   

    function SubmitOrder(Request $request)
    {
        // return $request;
        $this->validate($request, [            
            'photo' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        try {
        $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name, $request->file('photo'));
        }
        
        $order =  new order();         
        $order->penerima = $request['penerima'];
        $order->alamat = $request['alamat'];
        $order->nomor_hp = $request['nomor_hp'];
        $order->kode_order = $this->GenerateKodeOrder();
        $order->customer_id = Auth::id();
        // $order->admin_id = '';           
        // $order->kurir_id = '';
        $order->biaya_kirim = '0';
        $order->foto = $photo;
        $order->status_data = 'unvalidate';
        // $order->pengiriman_id = '';
        $order->save();   

        Alert::success('Data Berhasil ditambahkan', 'Mohon menunggu validasi oleh admin');
        // Alert::toast('Data Berhasil ditambahkan','success');
        return redirect(route('CreateOrder'))
                ->with(['success' => '<strong>' . $order->kode_order . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function GetAllPendingOrder()
    {
        $role = Auth::user()->role;
        $id   = Auth::user()->id;

        if ($role == 'admin') {
            $order = DB::table('orders')
                    ->where('status_data', 'unvalidate')                    
                    ->get();  
            // return $order[0]->penerima;      
            return view('admin.pending_order', compact('order'));
        }
        elseif ($role == 'kurir'){            
            $order = DB::table('orders')
                    ->where('status_data', 'valid')
                    ->where('kurir_id', $id)
                    ->where('status_pembayaran', 'paid')  
                    ->where('pengiriman_id', null)  
                    ->get();
            // return $order;
            return view('admin.pending_order', compact('order'));
        }
        elseif ($role == 'customer'){        
            $order = DB::table('orders')
                    ->where('status_data', 'unvalidate')
                    ->where('customer_id', $id)
                    ->get();      
                    return view('admin.pending_order', compact('order'));                }  
        
    }

    public function GetPendingOrder($id)
    {
        // return $id;
        $order = order::findOrFail($id);        
        // $kurir = DB::table('users')
        //             ->where('status_kurir', 'available')                    
        //             ->get();  
                    // return $kurir;                           
        return view('admin.validate', compact('order','kurir'));
    }
    

    function SubmitValidasi(Request $request)
    {
        $order = order::where('kode_order', $request['kode_order'])->get();
        $customer_id = $order[0]->customer_id;
        // return $order[0]->customer_id;        
        $users = User::where('id', $customer_id)->get();

        // return $users;

        try {        
            $id   = Auth::user()->id;

            order::where('kode_order', $request['kode_order'])
            ->update(array('biaya_kirim' => $request['biaya_kirim'],
                            'status_data' => $request['status_data'],
                            'admin_id' => $id));
            
        Alert::success('Data Berhasil divalidasi');  

        Notification::send($users, new NeedPayment());      

        return redirect(route('GetAllPendingOrder'));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function GetAllUnpaidOrder()
    {
        $role = Auth::user()->role;
        $id   = Auth::user()->id;

        if ($role == 'admin') {
            $order = DB::table('orders')
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'unpaid')  
                    ->where('foto_transfer', '=', null)                    
                    ->get();  
            // return $order[0]->penerima;      
            return view('admin.unpaid_order', compact('order'));
        }
        elseif ($role == 'kurir'){
            return 'hehe';
            $order = DB::table('orders')
                    ->where('status_data', 'unvalidate')
                    ->orWhere('kurir_id', $id)
                    ->get();
            return $order;
        }
        elseif ($role == 'customer'){
            $order = DB::table('orders')
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'unpaid')   
                    ->where('foto_transfer', '=', 'kosong')                      
                    ->get();  
            // return $order[0]->penerima;      
            return view('admin.unpaid_order', compact('order'));
        }
        
        
    }

    public function GetUnpaidOrder($id)
    {
        // return $id;
        $order = order::findOrFail($id);        
        $kurir = DB::table('users')
                    ->where('status_kurir', 'available')                    
                    ->get();  
                    // return $kurir;                           
        return view('customer.upload_trf', compact('order','kurir'));
    }

    function SubmitFotoTransfer(Request $request)
    {
        
        try {    
        
        $photo = 'kosong';
            if ($request->hasFile('foto_transfer')) {
                $photo = $this->saveFileTransfer($request->name, $request->file('foto_transfer'));
        }
            
            order::where('kode_order', $request['kode_order'])
            ->update(array('foto_transfer' => $photo));
            
        Alert::success('Bukti Transfer Berhasil ditambahkan', 'Mohon menunggu validasi oleh admin');
        return redirect(route('WaitPaymentConfirmation'));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function ValidateTransferOrder($id)
    {
        
        
        // return $id;
        $order = order::findOrFail($id);        
        // $kurir = DB::table('users')
        //             ->where('status_kurir', 'available')                    
        //             ->get();  
                    // return $kurir;                           
        return view('admin.validate_transfer', compact('order','kurir'));
    }

    function SubmitValidTransfer(Request $request)
    {
        
        try {        
            // $order = order::where('kode_order', $request['kode_order'])->get();
            // $customer_id = $order[0]->customer_id;
            // // return $customer_id;        
            // $users = User::where('id', $customer_id)->get();
            // // Notification::send($users, new NeedPayment());      


            $kurir_id = DB::table('users')
                        ->where('status_kurir', 'available')                    
                        ->orderBy('updated_at', 'ASC')
                        ->take(1)->get();
            // return $kurir_id[0]->id;   
            $users = User::where('id', $kurir_id[0]->id)->get();                     

            order::where('kode_order', $request['kode_order'])
            ->update(array('status_pembayaran' => $request['status_pembayaran'],
                            'kurir_id' => $kurir_id[0]->id));
            
        Alert::success('Data Berhasil divalidasi','Akan dilanjutkan pencarian kurir');

        Notification::send($users, new KonfirmasiKurir());
        // Notification::send($users, new OrderOnprogress());

        return redirect(route('WaitPaymentConfirmation'));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function WaitPaymentConfirmation()
    {
        $role = Auth::user()->role;
        $id   = Auth::user()->id;

        if ($role == 'customer'){
            $order = DB::table('orders')
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'unpaid')   
                    ->where('foto_transfer', '!=', 'kosong')                      
                    ->get();  
            // return $order[0]->penerima;      
            return view('customer.wait_payment_order', compact('order'));
        }  
        elseif ($role == 'admin'){
            $order = DB::table('orders')
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'unpaid')                       
                    ->where('foto_transfer', '!=', 'kosong')                     
                    ->get();  
            // return $order[0]->penerima;      
            return view('customer.wait_payment_order', compact('order'));
        }   
                   
    }

    function KurirConfirmOrder($id)
    {
        // return $id;  
        $order = order::where('id', $id)->get();
        $customer_id = $order[0]->customer_id;
        // return $customer_id;        
        $users = User::where('id', $customer_id)->get();
         
                
        
        try {            

            $pengiriman = new pengiriman();         
            $pengiriman->order_id = $id;      
            $pengiriman->diambil = "ok";           
            $pengiriman->save();   

            $pengiriman_id = DB::table('pengirimen')
                        ->where('order_id', $id)                    
                        ->take(1)->get();
            // return $kurir_id[0]->id;                        

            order::where('id', $id)
            ->update(array('pengiriman_id' => $pengiriman_id[0]->id));
    
            Alert::success('Order Berhasil Dikonfirmasi', 'Silahkan Melanjutkan Proses Pengurusan Tilang');
            Notification::send($users, new OrderOnprogress());
            // Alert::toast('Data Berhasil ditambahkan','success');
            return redirect(route('GetAllPendingOrder'));
            } catch (\Exception $e) {
                return  $e->getMessage();
            }
    }

    public function GetAllOnprogressOrder()
    {
        $role = Auth::user()->role;
        $id   = Auth::user()->id;

        if ($role == 'admin') {
            $order = order::whereHas('pengiriman', function ($query) use($id) {
                $query->where('diterima', '=', null);
            })
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'paid')  
                    ->where('pengiriman_id', '!=' ,null)                 
                    ->get();  
            // return $order;      
            return view('admin.onprogress_order', compact('order'));
        }
        elseif ($role == 'kurir'){
            $order = order::whereHas('pengiriman', function ($query) use($id) {
                $query->where('diterima', '=', null);
            })
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'paid')  
                    ->where('pengiriman_id', '!=' ,null)    
                    ->where('kurir_id', $id)             
                    ->get();  
            // return $order;      
            return view('admin.onprogress_order', compact('order'));
        }
        elseif ($role == 'customer'){
            $order = order::whereHas('pengiriman', function ($query) use($id) {
                $query->where('diterima', '=', null);
            })
                    ->where('status_data', 'valid')                    
                    ->where('status_pembayaran', 'paid')  
                    ->where('pengiriman_id', '!=' ,null)    
                    ->where('customer_id', $id)             
                    ->get();  
            // return $order;      
            return view('admin.onprogress_order', compact('order'));
        }
        
        
    }

    public function GetOnprogressOrder($id)
    {
        // return $id;
        $pengiriman = DB::table('pengirimen')
                    // ->where('status_data', 'valid')                    
                    // ->where('status_pembayaran', 'paid')  
                    // ->where('pengiriman_id', '!=' ,'0')    
                    ->where('order_id', $id)             
                    ->first();         
        // return $order;
        return view('kurir.update_pengiriman', compact('pengiriman'));
    }

    function UpdateStatusPengiriman(Request $request)
    {

        $order = order::where('pengiriman_id', $request['id'])->get();
        $customer_id = $order[0]->customer_id;
        // return $customer_id;        
        $users = User::where('id', $customer_id)->get();
        
        // return  $request;
        try {        

            if ($request['diterima'] != null) {
                Notification::send($users, new OrderComplete());
            }            

            $kurir_id = DB::table('users')
                        ->where('status_kurir', 'available')                    
                        ->orderBy('updated_at', 'ASC')
                        ->take(1)->get();
            // return $kurir_id[0]->id;                        

            pengiriman::where('id', $request['id'])
            ->update(array(
                'diambil'       => $request['diambil'],
                'antri'         => $request['antri'],
                'diantar'       => $request['diantar'],
                'diterima'      => $request['diterima'],
                'nama_penerima' => $request['nama_penerima'],
            ));
            
            
        Alert::success('Status Pengirim Berhasil Diupdate'); 
                 
        return redirect(route('GetAllOnprogressOrder'));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function GetAllCompleteOrder()
    {
        // $this->sendSMS();
        // $users= DB::table('users')
        // ->where('id', '3')                            
        // ->get();

        $users = User::where('id', 3)->get();

        // return $users;

        // Notification::send($users, new NeedPayment());

        $role = Auth::user()->role;
        $id   = Auth::user()->id;

        if ($role == 'admin') {
            $order = order::whereHas('pengiriman', function ($query) use($id) {
                $query->where('diterima', '=', 'ok');
            })->get();  
            // return $order;      
            return view('admin.complete_order', compact('order'));
        }
        elseif ($role == 'kurir'){
            $order = order::whereHas('pengiriman', function ($query) use($id) {
                $query->where('diterima', '=', 'ok');
            })->where('kurir_id', $id)->get();
            // return $order;      
            return view('admin.complete_order', compact('order'));
        }
        elseif ($role == 'customer'){
            $order = order::whereHas('pengiriman', function ($query) use($id) {
                $query->where('diterima', '=', 'ok');
            })->where('customer_id', $id)->get();  
            // return $order;      
            return view('admin.complete_order', compact('order'));
        }
        
        
    }

    public function DetailOrder($id)
    {
        // $this->sendSMS();
        // $users= DB::table('users')
        // ->where('id', '3')                            
        // ->get();

        // return $id;

        $users = User::where('id', 3)->get();

        // return $users;

        // Notification::send($users, new NeedPayment());

        $role = Auth::user()->role;
        $id_user   = Auth::user()->id;

        if ($role == 'admin') {
            $order = order::where('id',$id)->with('pengiriman')->get(); 
            $driver = User::where('id', $order[0]->kurir_id)->get();  
            // return $order;      
            return view('admin.detail_order', compact('order','driver'));
        }
        elseif ($role == 'kurir'){
            $order = order::where('kurir_id', $id_user)->where('id',$id)->with('pengiriman')->get(); 
            $driver = User::where('id', $order[0]->kurir_id)->get(); 

            // return $order;      
            return view('admin.detail_order', compact('order','driver'));
        }
        elseif ($role == 'customer'){
            $order = order::where('customer_id', $id_user)->where('id',$id)->with('pengiriman')->get();  
            // return $order[0]->kurir_id; 
            $driver = User::where('id', $order[0]->kurir_id)->get();
            // return $order[0]->pengiriman->diambil;   
            //  return $order;         
            return view('admin.detail_order', compact('order','driver'));
        }
        
        
    }
    
    
    
}
