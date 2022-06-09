@extends('layouts.master')

@section('content')
<!--================login_part Area =================-->
<section class="login_part padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>New to our Shop?</h2>
                        <p>There are advances being made in science and technology
                            everyday, and a good example of this is the</p>
                        <a href="\register" class="btn_3">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        @if(session()->has('success'))
                            <h3> {{ session('success') }} </h3>
                        @elseif(session()->has('loginError'))
                            <h3> {{ session('loginError') }} </h3>
                        @else
                            <h3>
                            @error('email')
                                Login failed!
                            @else 
                                Welcome Back ! <br>
                                    Please Sign in now
                            @enderror
                            </h3>
                        @endif
                        <form class="row contact_form" action="\login" method="post">
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Email or Phone Number" required>
                                @error('email')
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
                            <div class="col-md-12 form-group">
                                <div class="creat_account d-flex align-items-center">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">Remember me</label>
                                </div>
                                <button type="submit" value="submit" class="btn_3">
                                    log in
                                </button>
                                <a class="lost_pass" href="#">forget password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================login_part end =================-->
@endsection