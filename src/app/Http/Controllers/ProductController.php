<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\Category;
use File;
use Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin');
        $products = Product::all()->sortBy('c_id');
        $categories = Category::all();
        return view('admin.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('isAdmin');

        $request->validate([
            'price' => 'required',
            'c_description' => 'required|unique:component',
            'stock' => 'required',
            'categories_id' => 'required',
            'image' => 'required',
            'weight' => 'required'
        ]);

        // $image = time().'.'.$request->image->extension();

        $product = new Product;

        // $product->name = $request->name;
        $product->c_price = $request->price;
        // $product->weight = $request->weight;
        $product->c_description = $request->c_description;
        $product->c_qty = $request->stock;
        $product->cc_id = $request->categories_id;
        $product->c_img = $request->image;
        $product->c_weight = $request->weight;
   
        $product->save();
        // $request->image->move(public_path('images/product'), $image);

        Alert::success('Success', 'Product Successfully Created!');
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin');
        $categories = Category::all();
        $product = Product::findorfail($id);
        // dd($categories);
        return view('admin.edit', compact('categories', 'product'));
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
        $this->authorize('isAdmin');

        $validated = $request->validate([
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'categories_id' => 'required',
            'image' => 'required',
            'weight' => 'required'
        ]);

        // dd($validated);

        $product = Product::findorfail($id);
        // dd($product);
        // if ($request->has('image')) {
        //     $path = "images/product/";
        //     File::delete($path . $product->image);
        //     $image = time().'.'.$request->image->extension();

        //     $request->image->move(public_path('images/product'), $image);

        //     $product_data = [
        //         'name' => $request->name,
        //         'price' => $request->price,
        //         'weight' => $request->weight,
        //         'description' => $request->description,
        //         'stock' => $request->stock,
        //         'categories_id' => $request->categories_id,
        //         'image' => $image
        //     ];
        // } else {
            
        //     $product_data = [
        //         'name' => $request->name,
        //         'price' => $request->price,
        //         'weight' => $request->weight,
        //         'description' => $request->description,
        //         'stock' => $request->stock,
        //         'categories_id' => $request->categories_id,
        //     ];
        // }

        $product_data = [
            'c_description' => $request->description,
            'c_price' => $request->price,
            'c_qty' => $request->stock,
            'cc_id' => $request->categories_id,
            'c_img' => $request->image,
            'c_weight' => $request->weight
        ];

        
        // dd($product->update($product_data));
        $product->update($product_data);

        Alert::success('Success', 'Product Successfully Updated!');
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        
        $product = Product::findorfail($id);

        // $path = "images/product/";
        // File::delete($path . $product->image);
        $product->delete();

        Alert::success('Success', 'Product Successfully Removed!');
        return redirect('/product');
    }
}
