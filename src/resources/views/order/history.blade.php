@extends('layouts.master');

@section('content')
<section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        @php
            $count = 0
        @endphp
        <div class="table-responsive">
        @forelse ($dataOrders as $key => $item) 
        @php
            $count = $count+1;
        @endphp
        <h2>Order {{ $count }}  </h2>
          <table class="table">
            <thead>
              <tr>
                <th class="col-6" scope="col">Product</th>
                <th class="col-2" scope="col">Price</th>
                <th class="col-2" scope="col">Quantity</th>
                <th class="col-2" scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($dataOrderDetails as $key => $itemDua)   
                    @if($itemDua->orders_id == $item->id) 
                        <tr>
                            <td>
                            <div class="media">
                                <div class="d-flex">
                                @if (Str::contains($itemDua->image, 'https:/'))
                                    <img src="{{$itemDua->image}}" alt="image" height="200px">
                                @else
                                    <img src="{{ asset('images/product/'.$itemDua->image)}}" alt="image" height="200px">
                                @endif
                                </div>
                                <div class="media-body">
                                <p>{{ $itemDua->name }}</p>
                                </div>
                            </div>
                            </td>
                            <td>
                            <h5>{{ $itemDua->price }}</h5>
                            </td>
                            <td>
                            <div class="product_count">
                                {{ $itemDua->quantity }}
                            </div>
                        </td>
                        <td>
                            <h5>{{ $itemDua->total_price }}</h5>
                        </td>
                    </tr>
                    @endif
                @endforeach
              <tr>
                <td></td>
                <td></td>
                <td>
                    <h5>Subtotal</h5>
                </td>
                <td>
                    <h5>Rp {{ $item->amount }}</h5>
                </td>
              </tr>
            </tbody>
          </table>

        @empty
        <h4>There is no order history</h4>
        @endforelse
        </div>
      </div>
    </div>
  </section>
@endsection