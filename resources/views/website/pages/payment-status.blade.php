@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')


<section class="helping-one">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline">Payment</span>
            <h2 class="section-title__title">{{ strtoupper($data->payment_message) }}</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6">
                <div class="helping-one__right d-flex justify-content-center align-items-center">
                    <img src="{{ $data->payment_message = 'succeeded' ? asset('success.gif') : asset('error.gif') }}" alt="" srcset="" width="300px">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer-links')

@endsection