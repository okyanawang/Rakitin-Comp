@extends('layouts.master')

@section('content')
<section class="product_list section_padding">
    <div class="container">
        <h3 class="mb-4">Category : {{$category_name}}</h3>
        <div class="col-lg-12">
            <div class="row align-items-center justify-content-start">
                @forelse ($products as $product)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single_product_item" style="border: 2px solid #E7E9ED">
                            @if (Str::contains($product->c_img, 'https:/'))
                                <img src="{{$product->c_img}}" alt="image" style="width: 300px; height: 340px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/product/'.$product->c_img)}}" alt="image" style="width: 300px; height: 340px; object-fit: cover;">
                            @endif
                            <div class="single_product_text">
                                <h4>{{ $product->c_description }}</h4>
                                <h3>Rp {{ $product->c_price }}</h3>
                                <form action="shop" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->a_id }}" name="users_id">
                                    <input type="hidden" value="{{ $product->c_id }}" name="id">
                                    <input type="hidden" value="{{ $product->c_description }}" name="description">
                                    <input type="hidden" value="{{ $product->c_price }}" name="price">
                                    <input type="hidden" value="{{ $product->c_img }}"  name="image">
                                    <input type="hidden" value="1" name="quantity">
                                    <button class="px-4 py-2 text-black bg-blue-800 rounded">Add To Cart</button>
                                </form>
                                {{-- <a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a> --}}
                            </div>
                        </div>
                    </div>
                @empty
                     <h2 class="text-center">No item</h2>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection