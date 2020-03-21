<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function GetMasterData()
    {
        // $this->sendSMS();
        // $users= DB::table('users')
        // ->where('id', '3')                            
        // ->get();

        // return $id;

        $users = User::all();
        return $users;

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
