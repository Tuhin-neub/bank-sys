@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')
<style>
    * {
        box-sizing: border-box;
    }
    
    .pagination {
        display: inline-block;
    }
    
    .pagination a {
        text-decoration: none;
        color: #000;
        float: left;
        padding: 8px 16px;
    }
    
    .pagination1 a.active {
        background-color: #adc211;
        color: #FFF;
    }
    
    .pagination1 a:hover:not(.active) {
        background-color: #DDD;
    }
    
    .center {
        text-align: center;
    }
    
    ul.breadcrumb {
        list-style-type: none;
        background-color: #EEE;
        padding: 8px 16px;
    }
    
    ul.breadcrumb li {
        display: inline-block;
    }
    
    ul.breadcrumb li+li:before {
        padding: 8px;
        color: #000;
        content: "/\00A0";
    }
    
    ul.breadcrumb li a {
        color: green;
    }
    </style>
@endsection

@section('contents')

@include('website.layouts.breadcrumb')


 <!--News Page Start-->
 <section class="news-page">
    <div class="container">
        <div class="row">
            @foreach($newses as $data)
            <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                <!--News Two Single-->
                <div class="news-two__single">
                    <div class="news-two__img-box">
                        <div class="news-two__img">
                            <img src="{{ $data ? asset('storage/'.$data->cover_image) : '' }}" alt="">
                            <a href="{{route('news-details',$data->slug)}}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="news-two__date">
                            <p>{{date('d M, Y',strtotime($data->date))}}</p>
                        </div>
                    </div>
                    <div class="news-two__content">
                        <h3>
                            <a href="{{route('news-details',$data->slug)}}">{{ $data->title }}</a>
                        </h3>
                        {{-- <p class="news-two__text">There are many variations of but the majority have simply free text available not suffered.</p> --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-3 ">
            <div class="col-sm-12">
                {{ $newses->links('website.section.pagination.custom') }}
            </div>
        </div>
    </div>
</section>
<!--News Page End-->




@endsection

@section('footer-links')

@endsection