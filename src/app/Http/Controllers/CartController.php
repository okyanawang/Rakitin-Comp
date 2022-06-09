<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;

class CartController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
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
        // dd($sums);
        return view('carts.index', compact('cartItems', 'user', 'sums', 'orders_id'));
    }

    public function store(Request $request){
        $banyak = $request->quantity;
        $harga = $request->price;
        $res = $harga * $banyak;
        if($banyak < 1){
            DB::table('orders_detail')->where('id', $request->id)->delete();
        }else{
            $affected = DB::table('orders_detail')
                ->where('id', $request->id)
                ->update(['quantity' => $request->quantity, 'total_price' => $res]);
        }
        // dd($res);

        return redirect('/cart');
    }
}

