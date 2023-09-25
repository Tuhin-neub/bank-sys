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


 <!--Events Page Start-->
 <section class="events-page">
    <div class="container">
        <div class="row">
            @foreach($events as $data)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <!--Events One Single-->
                <div class="events-one__single">
                    <div class="events-one__img">
                        <img src="{{ $data->cover_image ? asset('storage/'.$data->cover_image) : '' }}" alt="">
                        <div class="events-one__date-box">
                            <p>{{date('d',strtotime($data->date))}} <br> {{date('M',strtotime($data->date))}}</p>
                        </div>
                        <div class="events-one__bottom">
                            <p><i class="far fa-clock"></i>8:00 pm</p>
                            <h3 class="events-one__bottom-title"><a href="{{route('event-details',$data->slug)}}">Play for the world
                                    <br> with us</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-3 ">
            <div class="col-sm-12">
                {{ $events->links('website.section.pagination.custom') }}
            </div>
        </div>
    </div>
</section>
<!--Events Page End-->


@endsection

@section('footer-links')

@endsection