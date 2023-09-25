@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

<!-- title section start -->
<section class="page-title-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 position-relative">
                <div class="page-title text-center">
                    <h1>{{ $page_title }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- title section end -->

@include('website.section.gallery')

@endsection

@section('footer-links')

@endsection