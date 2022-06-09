@extends('layouts.master')

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')

    <div class="container padding_top">
        <a href="/product/create" class="genric-btn primary radius mb-3">Create New Product</a>
        <table id="list-product" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Weight</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($products as $product)
                        <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if (Str::contains($product->image, 'https:/'))
                                <img src="{{$product->image}}" alt="image" height="75px">
                            @else
                                <img src="{{ asset('images/product/'.$product->image)}}" alt="image" height="75px">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->weight }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td class="d-flex justify-content-around">
                            <a href="/product/{{$product->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/product/{{$product->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                        </tr>
                    @empty
                        <td colspan="4" class="text-center">No Product</td>
                    @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
  <script>
    $(function () {
      $("#list-product").DataTable();
    });
  </script>
@endpush