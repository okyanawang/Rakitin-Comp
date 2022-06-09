@extends('layouts.master')

@section('content')
<!--================register_part Area =================-->
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Already have an account?</h2>
                        <p>There are advances being made in science and technology
                            everyday, and a good example of this is the</p>
                            <a href="/login" class="btn_3">Login to an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        @if(session()->has('failed'))
                            <h3> {{ session('failed') }} </h3>
                        @else 
                            <h3>Hello! <br>
                                Sign up now</h3>
                        @endif
                        <form class="row contact_form" action="/register" method="post">
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    placeholder="Username" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="Email address" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                    placeholder="Phone number" required value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                    placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" cols="50" 
                                    placeholder="Home address" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">Remember me</label>
                                </div>
                                <button type="submit" value="submit" class="btn_3">
                                    register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================register_part end =================-->
@endsection