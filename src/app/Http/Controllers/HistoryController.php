<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        
        $dataOrders = DB::table('orders')      
            ->select('*')
            ->where('orders.a_id_customer', $user->a_id)
            ->where('orders.transaction_status', '1')
            ->orderBy('orders.o_id', 'ASC')
            ->get();

        // dd($dataOrders);
        $dataOrderDetails = DB::table('order_details')   
            ->join('orders', 'order_details.o_id', '=', 'orders.o_id')   
            ->select('order_details.*')
            ->where('orders.a_id_customer', $user->a_id)
            ->where('orders.transaction_status', '1')
            ->get();

        // dd($dataOrderDetails);
        $dataComponent = DB::table('component') 
            ->join('component_category', 'component_category.cc_id', '=', 'component.cc_id')  
            ->select('component.c_id', 'component.c_img', 'component.c_price', 'component_category.cc_name')
            ->get();

        // dd($dataComponent);
        
        // dd($dataOrders);
        // dd($dataOrderDetails);
        return view('order.history', compact('dataOrders', 'dataOrderDetails', 'dataComponent'));
    }
}
