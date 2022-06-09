@extends('layouts.master')

@section('content')

    <section class="padding_top">
        <div class="container">
            <form action="{{route ('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                        @error('name')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control">
                        @error('price')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Weight</label>
                        <input type="number" name="weight" value="{{ $product->weight }}" class="form-control">
                        @error('weight')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" class="form-control">
                        @error('stock')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3"> {{ $product->description }} </textarea>
                        @error('description')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label> <br>
                        <select name="categories_id" class="form-control">
                            <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                @if ($category->id === $product->categories_id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                                @endforeach
                        </select> <br><br>
                        @error('category_id')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
        </div>
    </section>

@endsection    