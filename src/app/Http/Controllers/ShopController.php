<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;

class ShopController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $products = DB::table('products')->get();
        $categories = Category::all();
        $user = Auth::user();
        // dd($products);
        return view('shops.index', compact('products', 'user', 'categories'));
    }

    public function store(Request $request){
        // $this->middleware('auth');
        $unc = "unclear";
        $orders = DB::table('orders')
                     ->select('users_id')
                     ->where('users_id', $request["users_id"])
                     ->where('status', $unc)
                     ->first();

        // dd($orders);

        if(!$orders){
            $neworders = DB::table('orders')->insert([
                "users_id" => $request["users_id"],
                "amount" => 0,
                "shipping_address" => "none",
                "order_address" => "none",
                "order_date" => "2022-01-01",
                "status" => $unc
            ]);
        }

        // dd($neworders);

        $ambil_id = DB::table('orders')
        ->select('id')
        ->where('users_id', $request["users_id"])
        ->where('status', $unc)
        ->first();

        // dd($ambil_id);

        $pernah_order = DB::table('orders_detail')
            ->select('users_id')
            ->where('users_id', $request["users_id"])
            ->where('products_id', $request["id"])
            ->first();

        if(!$pernah_order){
            $query = DB::table('orders_detail')->insert([
                "users_id" => $request["users_id"],
                "products_id" => $request["id"],
                "price" => $request["price"],
                "total_price" => $request["price"],
                "quantity" => $request["quantity"],
                "image" => $request["image"],
                "name" => $request["name"],
                "orders_id" => $ambil_id->id
            ]);
        }else{
            $banyak_lama = DB::table('orders_detail')
            ->where('users_id', $request->users_id)
            ->where('products_id', $request->id)
            ->value('quantity');
            $banyak = $banyak_lama + 1;
            $harga = $request->price;
            $res = $harga * $banyak;
            $query = DB::table('orders_detail')
            ->where('users_id', $request->users_id)
            ->where('products_id', $request->id)
            ->update(['quantity' => $banyak, 'total_price' => $res]);
        }

        // dd($query);

        // return redirect('/shop')->with('success', 'Product added to cart successfully!');
        Alert::success('Success', 'Product Successfully Added!');
        return redirect('/shop')->with('success', 'Product added to cart successfully!');
    }
}
