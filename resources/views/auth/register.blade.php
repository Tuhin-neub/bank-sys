@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')


<section class="helping-one register-section">
    <div class="container">
        <div class="section-title text-center mt-1">
            <h2 class="section-title__title"> Register Now</h2>
        </div>
        <div class="row">
            <div class="col-xl-7 col-lg-7 m-auto">
                <div class="helping-one__right register-section-right">
                    <form action="{{ route('register') }}" method="POST"
                        class="helping-one__right-form helping-one__right-form-register">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="name" placeholder="Name*"
                                    value="{{ old('name') }}">
                                @error('name')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <select name="account_type" class="form-control" id="">
                                    <option value="">Select One*</option>
                                    <option value="1">Individual</option>
                                    <option value="2">Business</option>
                                </select>
                                @error('account_type')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="balance" placeholder="Balance*"
                                    value="{{ old('balance') }}">
                                @error('balance')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Address*"
                                    value="{{ old('email') }}">
                                @error('email')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="password" placeholder="Password*">
                                @error('password')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="password_confirmation"
                                    autocomplete="new-password" placeholder="Confirm Password*">
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="thm-btn register-btn helping-one__right-btn"><i
                                        class="fas fa-arrow-circle-right"></i>Register</button>
                                <a class="login-btn helping-one__right-btn float-end text-light"
                                    href="{{route('login')}}" type="Sign In"><i class="fas fa-arrow-circle-right"></i>
                                    Login
                                </a>
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