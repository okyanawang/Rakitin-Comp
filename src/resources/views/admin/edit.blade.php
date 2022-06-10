@extends('layouts.master')

@section('content')

    <section class="padding_top">
        <div class="container">
            <form action="{{route ('product.update', $product->c_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" value="{{ $product->c_price }}" class="form-control">
                        @error('price')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" value="{{ $product->c_qty }}" class="form-control">
                        @error('stock')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Weight</label>
                        <input type="number" name="weight" value="{{ $product->c_weight }}" class="form-control">
                        @error('weight')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3">{{ $product->c_description }} </textarea>
                        @error('description')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label> <br>
                        <select name="categories_id" class="form-control">
                            <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                @if ($category->cc_id === $product->cc_id)
                                    <option value="{{$category->cc_id}}" selected>{{$category->cc_name}}</option>
                                @else
                                    <option value="{{$category->cc_id}}">{{$category->cc_name}}</option>
                                @endif
                                @endforeach
                        </select> <br><br>
                        @error('categories_id')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" name="image" value="{{ $product->c_img }}" class="form-control">
                        @error('image')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
        </div>
    </section>

@endsection    