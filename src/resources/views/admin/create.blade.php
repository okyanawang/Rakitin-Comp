@extends('layouts.master')

@section('content')

    <section class="padding_top">
        <div class="container">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', '') }}" class="form-control">
                        @error('name')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" value="{{ old('price', '') }}" class="form-control">
                        @error('price')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Weight</label>
                        <input type="number" name="weight" value="{{ old('weight', '') }}" class="form-control">
                        @error('weight')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" value="{{ old('stock', '') }}" class="form-control">
                        @error('stock')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3"> {{ old('description', '') }} </textarea>
                        @error('description')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label> <br>
                        <select name="categories_id" class="form-control">
                            <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                        </select> <br><br>
                        @error('category_id')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" name="image" class="form-control">
                        @error('image')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </section>
@endsection