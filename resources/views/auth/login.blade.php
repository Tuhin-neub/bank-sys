@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')


<section class="helping-one register-section">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="section-title__title"> Login Now</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 m-auto">
                <div class="helping-one__right register-section-right">
                    <form action="{{ route('login') }}" method="POST"
                        class="helping-one__right-form helping-one__right-form-register">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                @error('email')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="password" name="password" placeholder="Password">
                                @error('password')
                                <span class="error_msg err-msg text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="thm-btn register-btn helping-one__right-btn"><i
                                        class="fas fa-arrow-circle-right"></i>Login</button>
                                <a class="login-btn helping-one__right-btn float-end text-light"
                                    href="{{route('register')}}" type="Sign In"><i
                                        class="fas fa-arrow-circle-right"></i>
                                    Register
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