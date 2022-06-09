@extends('layouts.master')

@section('content')
    <!-- banner part start-->
    <section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="banner_slider owl-carousel">
                    
                    <div class="single_banner_slider">
                        <div class="row">
                            <div class="col-lg-5 col-md-8">
                                <div class="banner_text">
                                    <div class="banner_text_iner">
                                        <h1>POP UP PARADE</h1>
                                        <p>Releases planned only four months after preorders, POP UP PARADE figures make scale figures easy to collect!</p>
                                        <a href="/shop" class="btn_2">BUY NOW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="banner_img d-none d-lg-block">
                                <img src="img/pvc-17-saberaltria-pendragon-disp.png" alt="">
                                {{-- <img src="img/banner_img.png" alt=""> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="slider-counter"></div>
            </div>
        </div>
    </div>
</section>
    <!-- banner part start-->

    <!-- product_list part start-->
    <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Best Sellers <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        @foreach ($products as $key => $item)
                            <div class="single_product_item">
                                <img src="{{ $item->image }}" alt="">
                                <div class="single_product_text">
                                    <h4>{{ $item->name }}</h4>
                                    <h3>Rp {{ $item->price }}</h3>
                                </div>
                                {{-- <form action="shop" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    <button action="shop" class="px-4 py-2 text-black bg-blue-800 rounded">Add To Cart</button>
                                </form> --}}
                                <a class="btn btn-outline-info px-4 py-2 text-black bg-blue-800 rounded" href="/shop">Add To Cart</a>
                            </div>
                        @endforeach
                    </div>
                    <br><br>
                    <div class="col text-center">
                        {{-- <button class="btn btn-default">Centered button</button> --}}
                        <a class="btn_2 btn-outline-info btn-block" href="/shop">Go to shops</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part end-->

@endsection

