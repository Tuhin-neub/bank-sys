@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'>
@endsection

@section('contents')

@include('website.layouts.breadcrumb')

<!--Causes Details Start-->
<section class="causes-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="causes-details__left-bar">
                    <div class="causes-details__img">
                        <div class="causes-details__img-box">
                            <img src="{{ $data ? asset('storage/'.$data->cover_image) : '' }}" alt="">

                            <div class="causes-details__category">
                                @if(Route::currentRouteName() == ('project-details'))
                                <span>{{$data->project_category->title}}</span>
                                @elseif(Route::currentRouteName() == ('appeal-details'))
                                <span>{{$data->appeal_category->title}}</span>
                                @endif

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
                        @if(Route::currentRouteName() == ('appeal-details'))
                        <div class="causes-details__progress">
                            <div class="bar">
                                @php
                                $percentage = ($data->rise_amount / $data->budget) * 100;
                                $formatted_percentage = number_format($percentage, 1);
                                if ($formatted_percentage > 100) {
                                $formatted_percentage = 100;
                                }
                                @endphp
                                <div class="bar-inner count-bar" data-percent="{{$formatted_percentage}}%">
                                    <div class="count-text">{{$formatted_percentage}}%</div>
                                </div>
                            </div>
                            @if($data->budget || $data->rise_amount)
                            <div class="causes-details__goals">
                                <p><span>{{$shop_info ? $shop_info->currency : ''}}{{$data->budget}}</span> Budget</p>
                                <p><span>{{$shop_info ? $shop_info->currency : ''}}{{$data->rise_amount}}</span> Raised
                                </p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                   
                </div>
                <div class="causes-details__text-box">
                    <h3>{{ $data->title }}</h3>
                    <p class="causes-details__text-1">{!! $data->details !!}</p>
                </div>
                <div class="causes-details__images-box">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="causes-details__images-single">
                                <img src="assets/images/resources/causes-details-images-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="causes-details__images-single">
                                <img src="assets/images/resources/causes-details-images-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="causes-details__share">
                    <div class="causes-details__share-btn-box d-flex">
                        @if(Route::currentRouteName() == ('appeal-details'))
                        @if($data->project_status != 2)
                        <a href="{{route('donate-to', $data->slug)}}" class="causes-details__share-btn thm-btn"><i
                                class="fas fa-arrow-circle-right"></i>Donate Us Now</a>
                        @endif
                        @endif
                        <div class="site-footer__bottom-social">
                            <span class="me-3">Share On: </span>
                            <a href="{{ $share_info['twitter'] }}" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="{{ $share_info['facebook'] }}" target="_blank"><i
                                    class="fab fa-facebook-square" target="_blank"></i></a>
                            <a href="{{ $share_info['linkedin'] }}" target="_blank"><i
                                    class="fab fa-linkedin" target="_blank"></i></a>
                            <a href="{{ $share_info['whatsapp'] }}" target="_blank"><i
                                    class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="causes-details__right">
                    <div class="event-details__right">
                        <div class="event-details__right-sidebar">
                            <div class="event-details__right-sidebar-title">
                                <h4>Project Info</h4>
                            </div>
                            <ul class="event-details__right-sidebar-list list-unstyled">
    
                                <li>
                                    <div class="left">
                                        <p>Sub Title:</p>
                                    </div>
                                    <div class="right">
                                        <h4>{{$data->sub_title}}</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="left">
                                        <p>Project Category:</p>
                                    </div>
                                    <div class="right">
                                        <a href="">
                                            @if(Route::currentRouteName() == ('project-details'))
                                            <h4>{{$data->project_category->title}}</h4>
                                            @elseif(Route::currentRouteName() == ('appeal-details'))
                                            <h4>{{$data->appeal_category->title}}</h4>
                                            @endif
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="left">
                                        <p>Date Time:</p>
                                    </div>
                                    <div class="right">
                                        <h4>{{date('h:i A | d M, Y',strtotime($data->created_at))}}</h4>
    
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="causes-details__donations">
                        <h3 class="causes-details__donations-title">Recent Project</h3>
                        <ul class="list-unstyled causes-details__donations-list">
                            @foreach($projects as $project)
                            @if($data->project_status == $project->project_status)
                            <li>
                                <div class="causes-details__donations-img">
                                    <img src="{{ $project ? asset('storage/'.$project->cover_image) : '' }}" alt="">
                                </div>
                                <div class="causes-details__donations-content">
                                    <a href="{{route('project-details',$project->slug)}}">
                                        <h5>{{$project->title}} <span>{{$project->small_details}}</span></h5>
                                    </a>
                                    <h5></h5>
                                    <p></p>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @if(Route::currentRouteName() == ('appeal-details'))
                    <div class="causes-details__donations">
                        <h3 class="causes-details__donations-title">Donation List</h3>
                        <ul class="list-unstyled causes-details__donations-list">
                            @foreach ($data->donatioins as $item)
                                <li class="d-flex justify-content-start align-items-start">
                                    <i class="fas fa-user me-2"></i>
                                    <div>
                                        <h6>{{ $item->name }}</h6>
                                        <span class="weight-900 text-dark">{{$shop_info ? $shop_info->currency : ''}}{{ $item->amount }}</span>
                                        <small class="text-font">{{ $item->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!--Causes Details End-->


@endsection

@section('footer-links')
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js'></script>
@endsection