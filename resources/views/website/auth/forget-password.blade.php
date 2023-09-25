@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')


<section class="helping-one register-section">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="section-title__title">Forget Password</h2>
            <p>Enter your email to reset your password</p>
        </div>
        <div class="row">
            @if (Session::has('error'))
            <div class="col-sm-12 col-md-12">
                <div class="alert alert-danger text-center">
                    {{-- <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> --}}
                    <p>{{ Session::get('error') }}</p>
                </div>
            </div>
            @endif
            <div class="col-xl-4 col-lg-4 m-auto">
                <div class="helping-one__right register-section-right">
                    <form action="{{ route('reset.password.link') }}" method="POST"
                        class="helping-one__right-form helping-one__right-form-register">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}"class="{{($errors->first('email') ? "border border-danger" : "")}}" value="{{ old('email') }}">
                                @error('email')
                                    <div><small class="text-danger"><strong>{{ $message }}</strong></small></div>
                                @enderror
                            </div>
                            
                            <div class="col-lg-12">
                                <button type="submit" class="thm-btn register-btn helping-one__right-btn w-100"><i
                                        class="fas fa-arrow-circle-right"></i>Send Reset Password Link</button>
                                
                            </div>
                            <div class="col-sm-12 ">
                                <a href="{{ route('login') }}" class="float-end forgot-link">Back to login ?</a>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer-links')

@endsection