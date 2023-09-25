@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'>
@endsection

@section('contents')

@include('website.layouts.breadcrumb')

<!--Events Details Start-->
<section class="event-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="events-details__img">
                    <img src="{{ $data->cover_image ? asset('storage/'.$data->cover_image) : '' }}" alt="">
                    
                    <div class="event-details__date-box">
                        <p>{{date('d',strtotime($data->date))}} <br> {{date('M',strtotime($data->date))}}</p>
                    </div>
                </div>
                <div class="row my-2">
                    @php
                    if (substr($data->images, -1) == ',') {
                    $images = substr($data->images, 0 , -1);
                    } else {
                    $images = $data->images;
                    }
                    $images = explode(',', $images)
                    @endphp
                    @foreach ($images as $image)
                    <div class="col-xl-1 col-lg-1 col-md-2 col-sm-3">
                        <!--Gallery page Single-->
                        <a href="{{ $image ? asset('storage/'.$image) : '' }}" data-fancybox="gallery" data-caption="Caption Images 1">
                            <img style="width:100%;height:100%;object-fit:cover"
                                        src="{{ $image ? asset('storage/'.$image) : '' }}" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="event-details__left">
                    <div class="event-details__top-content">
                        <h2 class="event-details__title">{{$data->title}}</h2>
                        <p class="event-details__text-1">{!! $data->details !!}</p>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="event-details__right">
                    <div class="event-details__right-sidebar">
                        <div class="event-details__right-sidebar-title">
                            <h4>Event Details</h4>
                        </div>
                        <ul class="event-details__right-sidebar-list list-unstyled">
                            <li>
                                <div class="left">
                                    <p>Starting Time:</p>
                                </div>
                                <div class="right">
                                    <h4>{{$data->time_range}}</h4>
                                </div>
                            </li>
                            <li>
                                <div class="left">
                                    <p>Date:</p>
                                </div>
                                <div class="right">
                                    <h4>{{date('d M, y',strtotime($data->date))}}</h4>
                                </div>
                            </li>
                            <li>
                                <div class="left">
                                    <p>Phone:</p>
                                </div>
                                <div class="right">
                                    <h4>{{$data->contact_number}}</h4>
                                </div>
                            </li>
                            <li>
                                <div class="left">
                                    <p>Location:</p>
                                </div>
                                <div class="right">
                                    <h4>{{$data->location}}</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            @php
            if (substr($data->images, -1) == ',') {
            $images = substr($data->images, 0 , -1);
            } else {
            $images = $data->images;
            }
            $images = explode(',', $images)
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
        </div> --}}
    </div>
</section>



<!--Events Details End-->


@endsection

@section('footer-links')
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js'></script>

@endsection