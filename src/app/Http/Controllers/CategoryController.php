<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $products = Product::where('categories_id', $id)->get();
        $category_name = Category::where('id', $id)->select('name')->pluck('name')->first();
        // dd($products);
        return view('category.index', compact('products', 'category_name'));
    }
}
