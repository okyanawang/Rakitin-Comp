@extends('layouts.master');

@section('content')
<section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $key => $item)    
                    <tr>
                        <td>
                        <div class="media">
                            <div class="d-flex">
                              @if (Str::contains($item->image, 'https:/'))
                                  <img src="{{$item->image}}" alt="image" height="200px">
                              @else
                                  <img src="{{ asset('images/product/'.$item->image)}}" alt="image" height="200px">
                              @endif
                            </div>
                            <div class="media-body">
                            <p>{{ $item->name }}</p>
                            </div>
                        </div>
                        </td>
                        <td>
                        <h5>{{ $item->price }}</h5>
                        </td>
                        <td>
                        <div class="product_count">
                            <form action="cart" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->id }}" name="users_id">
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                {{-- <input type="hidden" value="{{ $item->name }}" name="name"> --}}
                                <input type="hidden" value="{{ $item->price }}" name="price">
                                <input type="hidden" value="{{ $item->quantity - 1 }}" name="quantity">
                                {{-- <input type="hidden" value="dec" name="idcnt"> --}}
                                <button class="input-number-decrement"><i class="ti-angle-down"></i></button>
                            </form>
                            {{-- <span class="input-number-decrement"> <i class="ti-angle-down"></i></span> --}}
                            <input class="input-number" type="text" value="{{ $item->quantity }}" name="counter" min="0" max="10">
                            <form action="cart" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->id }}" name="users_id">
                                <input type="hidden" value="{{ $item->id }}" name="id">
                                {{-- <input type="hidden" value="{{ $item->name }}" name="name"> --}}
                                <input type="hidden" value="{{ $item->price }}" name="price">
                                <input type="hidden" value="{{ $item->quantity + 1 }}" name="quantity">
                                {{-- <input type="hidden" value="add" name="idcnt"> --}}
                                <button class="input-number-increment"><i class="ti-angle-up"></i></button>
                            </form>
                            {{-- <span class="input-number-increment"> <i class="ti-angle-up"></i></span> --}}
                        </div>
                        </td>
                        <td>
                        <h5>{{ $item->total_price }}</h5>
                        </td>
                    </tr>
                @empty
                    <h4>No Item</h4>
                @endforelse
              {{-- <tr class="bottom_button">
                <td>
                  <a class="btn_1" href="#">Update Cart</a>
                </td>
                <td></td>
                <td></td>
                <td>
                  <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div>
                </td>
              </tr> --}}
              <tr>
                <td></td>
                <td></td>
                <td>
                    <h5>Subtotal</h5>
                </td>
                <td>
                    <h5>Rp {{ $sums }}</h5>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="/shop">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="/order/{{$orders_id}}/edit">Proceed to checkout</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection