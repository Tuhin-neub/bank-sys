@php
    $shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')
<link href="{{ asset('all/website/assets/css/member-form.css') }}" rel="stylesheet">
@endsection

@section('contents')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">

            <div class="row">
                <div class="col-sm-11 col-md-11">
                    <br>
                    <h1>Forget Password</h1>
                    <p>Enter your email to reset your password</p>
                    <hr>
                </div>
            </div>
            @if (Session::has('error'))
                <div class="col-sm-12 col-md-12">
                    <div class="alert alert-danger text-center">
                        {{-- <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> --}}
                        <p>{{ Session::get('error') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('reset.password.link') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <label for="email"><b>Email<span class="text-danger">*</span></b></label>
                        <input type="text" placeholder="Enter Email" name="email" id="email" class="{{($errors->first('email') ? "border border-danger" : "")}}" value="{{ old('email') }}">
                        @error('email')
                                <div><small class="text-danger"><strong>{{ $message }}</strong></small></div>
                        @enderror
                    </div>
                    <div class="col-sm-12 col-md-12 text-right my-2">
                        <a href="{{ route('login') }}" class="text-danger">Back to login ?</a>
                    </div>
                    <div class="col-sm-12 col-md-12 d-flex align-items-center">
                        <button type="submit" class="registerbtn my-0">Send Reset Password Link</button>
                    </div>
                </div>
            
                <hr>
    
                
            </form>
        </div>
    </div>
</div>
    


@endsection

@section('footer-links')

@endsection