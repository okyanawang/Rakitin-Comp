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
        $products = Product::all();
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
            'name' => 'required|unique:products',
            'price' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'categories_id' => 'required',
            'image' => 'required',
        ]);

        // $image = time().'.'.$request->image->extension();

        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->categories_id = $request->categories_id;
        $product->image = $request->image;
   
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

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'categories_id' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
        ]);

        $product = Product::findorfail($id);

        if ($request->has('image')) {
            $path = "images/product/";
            File::delete($path . $product->image);
            $image = time().'.'.$request->image->extension();

            $request->image->move(public_path('images/product'), $image);

            $product_data = [
                'name' => $request->name,
                'price' => $request->price,
                'weight' => $request->weight,
                'description' => $request->description,
                'stock' => $request->stock,
                'categories_id' => $request->categories_id,
                'image' => $image
            ];
        } else {
            
            $product_data = [
                'name' => $request->name,
                'price' => $request->price,
                'weight' => $request->weight,
                'description' => $request->description,
                'stock' => $request->stock,
                'categories_id' => $request->categories_id,
            ];
        }

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
