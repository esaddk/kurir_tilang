<?php

namespace App\Http\Controllers;

use File;
use App\order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{    

    public function CreateOrder()
    {
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
        $order->status_pengiriman = '';
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
            return 'hehe';
            $order = DB::table('orders')
                    ->where('status_data', 'unvalidate')
                    ->orWhere('kurir_id', $id)
                    ->get();
            return $order;
        }
        elseif ($role == 'customer'){
            return 'ahai';
            $order = DB::table('orders')
                    ->where('status_data', 'unvalidate')
                    ->orWhere('kurir_id', $id)
                    ->get();      
            return $order;
        }
        
        
    }

    public function GetPendingOrder($id)
    {
        // return $id;
        $order = order::findOrFail($id);        
        $kurir = DB::table('users')
                    ->where('status_kurir', 'available')                    
                    ->get();  
                    // return $kurir;                           
        return view('admin.validate', compact('order','kurir'));
    }

    function SubmitValidasi(Request $request)
    {
        
        try {        
            order::where('kode_order', $request['kode_order'])
            ->update(array('biaya_kirim' => $request['biaya_kirim'],
            'status_data' => $request['status_data']));
            
        Alert::success('Data Berhasil divalidasi');        
        return redirect(route('CreateOrder'));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }
    
}
