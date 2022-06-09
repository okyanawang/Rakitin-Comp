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
            ->where('orders.users_id', $user->id)
            ->where('orders.status', 'clear')
            ->get();
        $dataOrderDetails = DB::table('orders_detail')   
            ->join('orders', 'orders_detail.orders_id', '=', 'orders.id')   
            ->select('orders_detail.*')
            ->where('orders.users_id', $user->id)
            ->where('orders.status', 'clear')
            ->get();

        $sums = 0;
        // dd($dataOrders);
        // dd($dataOrderDetails);
        return view('order.history', compact('dataOrders', 'dataOrderDetails'));
    }
}
