@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')

<!--Events Details Start-->
<section class="event-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="event-details__left">
                    <div class="event-details__top-content">
                        {!! $data ? $data->details : '' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @php

            $images = (!empty($data->images)) ? ((substr($data->images, -1) == ',') ? substr($data->images, 0 , -1) :
            $data->images) : '';
            $images = (!empty($images)) ? explode(',', $images) : array();

            @endphp
            @foreach ($images as $image)
            <div class="col-xl-3 col-lg-6 col-md-6">
                <!--Gallery page Single-->
                <div class="gallery-page__single">
                    <div class="gallery-page__img-box">
                        @if($image)
                        <img style="width:260px;height:300px;object-fit:cover"
                            src="{{ $image ? asset('storage/'.$image) : '' }}" alt="">
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!--Events Details End-->

@endsection

@section('footer-links')

@endsection