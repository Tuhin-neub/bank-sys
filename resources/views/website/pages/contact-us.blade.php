@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')

<!--Contact page Start-->
<section class="contact-page">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">Contact With Us</span>
            <h2 class="section-title__title">We love to hear from our <br> happy customers</h2>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__left">
                    <div class="contact-page__img">
                        <img src="{{ $about_more ? asset('storage/'.$about_more->images) : '' }}" alt="">
                    </div>
                    <p class="contact-page__text">{{ $shop_info ? $shop_info->short_description : '' }}</p>
                    <div class="contact-page__contact-info">
                        <ul class="contact-page__contact-list list-unstyled">
                            <li>
                                <div class="icon">
                                    <span class="icon-chat"></span>
                                </div>
                                <div class="text">
                                    <p>Call Anytime</p>
                                    <a
                                        href="tel:{{$shop_info ? $shop_info->phone : ''}}">{{$shop_info ? $shop_info->phone : ''}}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-message"></span>
                                </div>
                                <div class="text">
                                    <p>Send Email</p>
                                    <a
                                        href="mailto:{{$shop_info ? $shop_info->email : ''}}">{{$shop_info ? $shop_info->email : ''}}</a>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-address"></span>
                                </div>
                                <div class="text">
                                    <p>Address</p>
                                    <h5>{{$shop_info ? $shop_info->address : ''}}</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="contact-page__form">
                    @if(session()->has('success'))
                    <div class="alert alert-success text-center">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger text-center">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('sent-message') }}"
                        class="contact-page__main-form contact-form-validated">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-page__input-box">
                                    <input class="{{($errors->first('name') ? "border border-danger" : "")}}"
                                        value="{{ old('name') }}" type="text" placeholder="Your name" name="name">
                                    @error('name')
                                    <span class="error_msg err-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="contact-page__input-box">
                                    <input class="{{($errors->first('email') ? "border border-danger" : "")}}"
                                        value="{{ old('email') }}" type="email" placeholder="Email address"
                                        name="email">
                                    @error('email')
                                    <span class="error_msg text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact-page__input-box">
                                    <input class="{{($errors->first('subject') ? "border border-danger" : "")}}"
                                        value="{{ old('subject') }}" type="text" placeholder="Subject" name="subject">
                                    @error('subject')
                                    <span class="error_msg text-danger ">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-page__input-box">
                                    <input class="{{($errors->first('phone') ? "border border-danger" : "")}}"
                                        value="{{ old('phone') }}" type="text" placeholder="phone Number" name="phone">
                                    @error('phone')
                                    <span class="error_msg text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-page__input-box">
                                    <textarea class="{{($errors->first('message') ? "border border-danger" : "")}}"
                                        name="message" placeholder="Write message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <span class="error_msg text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="thm-btn contact-page__btn"><i
                                        class="fas fa-arrow-circle-right"></i>Send a Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact page End-->

<!--Contact Page Google Map Start-->
<section class="contact-page-google-map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4562.753041141002!2d-118.80123790098536!3d34.152323469614075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80e82469c2162619%3A0xba03efb7998eef6d!2sCostco+Wholesale!5e0!3m2!1sbn!2sbd!4v1562518641290!5m2!1sbn!2sbd"
        class="contact-page-google-map__one" allowfullscreen></iframe>

</section>
<!--Contact Page Google Map End-->

@endsection

@section('footer-links')

@endsection