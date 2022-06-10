<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Order;
// use App\OrderDetail;
use App\User;
use Auth;
use DB;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $orders_id = DB::table('orders')
            ->where('a_id_customer', $user->a_id)
            ->where('transaction_status', '0')
            ->select('o_id')
            ->pluck('o_id')->first();
        $cartItems = DB::table('order_details')
            ->join('component', 'component.c_id' , '=', 'order_details.c_id')
            ->where('order_details.o_id', $orders_id)->get();
        $sums = DB::table('order_details')
            ->join('component', 'component.c_id' , '=', 'order_details.c_id')
            ->where('order_details.o_id', $orders_id)
            ->sum(DB::raw('order_details.od_qty * component.c_price'));
        // dd($sums);

        return view('order.edit', compact('cartItems', 'orders_id', 'sums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_address' => 'required',
        ]);
        $sums = DB::table('order_details')
            ->join('component', 'component.c_id' , '=', 'order_details.c_id')
            ->where('order_details.o_id', $id)
            ->sum(DB::raw('order_details.od_qty * component.c_price'));

        // dd($sums);
        $query = DB::table('orders')
                -> where('o_id', $id)
                -> update([
                    'o_total_price' => $sums,
                    'o_address' => $request['order_address'],
                    'o_date' => date('Y-m-d'),
                    'transaction_status' => '1'
                ]);

        return redirect('/shop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
