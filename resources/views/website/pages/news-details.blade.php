@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'>

@endsection

@section('contents')

    @include('website.layouts.breadcrumb')

  <!--News Details Start-->
  <section class="news-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="news-details__left">
                    <div class="news-details__img">
                        <img src="{{ $data->cover_image ? asset('storage/'.$data->cover_image) : '' }}" alt="">
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
                    <div class="news-details__content">
                        <ul class="list-unstyled news-details__meta">
                            <li><a href="#"><i class="far fa-calendar"></i> {{date('d M, Y',strtotime($data->date))}}</a>
                            </li>
                        </ul>
                        <h3 class="news-details__title">{{$data->title}}</h3>
                        <p class="news-details__text-one">{!! $data->details !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">
                    <div class="sidebar__single sidebar__search">
                        <div class="sidebar__search-form">
                            <h3 class="sidebar__title sidebar__search-form text-white p-3">Recent Posts</h3>
                        </div>
                    </div>
                    <div class="sidebar__single sidebar__post">
                        <ul class="sidebar__post-list list-unstyled">
                            @foreach($posts as $data)
                            <li>
                                <div class="sidebar__post-image">
                                    <img src="{{ $data->cover_image ? asset('storage/'.$data->cover_image) : '' }}" alt="">
                                </div>
                                <div class="sidebar__post-content">
                                    <h3>
                                        <a href="{{route('news-details',$data->slug)}}" class="sidebar__post-content_meta"><i class="far fa-calendar"></i>{{date('d M, Y',strtotime($data->date))}}</a>
                                        <a href="{{route('news-details',$data->slug)}}">{{$data->title}}</a>
                                    </h3>
                                </div>
                            </li>
                            @endforeach
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
                            <img style="width:260px;height:300px;object-fit:cover" src="{{ $image ? asset('storage/'.$image) : '' }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
    
</section>
<!--News Details End-->

@endsection

@section('footer-links')
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js'></script>
@endsection