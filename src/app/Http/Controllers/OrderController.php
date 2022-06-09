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
            ->where('users_id', $user->id)
            ->where('status', 'unclear')
            ->select('id')
            ->pluck('id')->first();
        $cartItems = DB::table('orders_detail')->get()
            ->where('users_id', $user->id)
            ->where('orders_id', $orders_id);
        $sums = DB::table('orders_detail')
            ->where('users_id', $user->id)
            ->where('orders_id', $orders_id)
            ->sum('total_price');

        // dd($cartItems);

        return view('order.edit', compact('cartItems', 'sums', 'orders_id'));
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
            'shipping_address' => 'required',
        ]);
        $sums = DB::table('orders_detail')
            ->where('users_id', Auth::id())
            ->where('orders_id', $id)
            ->sum('total_price');

        // dd($sums);
        $query = DB::table('orders')
                -> where('id', $id)
                -> update([
                    'amount' => $sums,
                    'shipping_address' => $request['shipping_address'],
                    'order_address' => $request['order_address'],
                    'order_date' => date('Y-m-d'),
                    'status' => 'clear'
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
