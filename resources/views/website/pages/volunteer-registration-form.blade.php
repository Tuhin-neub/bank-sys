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
        <div class="section-title text-center ">
            <h2 class="section-title__title">Volunteer Membership</h2>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-8 m-auto">
                <div class="helping-one__right">
                    <form action="{{route('user.volunteer-registration-store')}}" method="POST"
                        class="helping-one__right-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ Auth::user() ? Auth::user()->id : ''  }}">
                            <div class="col-lg-6">
                                <label for="">First Name</label>
                                <input type="text" name="name"
                                    value="{{ Auth::user() ? Auth::user()->first_name : ''  }}" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Last Name</label>
                                <input type="text" name="name"
                                    value="{{ Auth::user() ? Auth::user()->last_name : ''  }}" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{ Auth::user() ? Auth::user()->email : ''  }}"
                                    readonly>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Phone</label>
                                <input type="text" name="phone"
                                    value="{{ Auth::user()->user_more_info ? Auth::user()->user_more_info->phone : ''  }}"
                                    readonly>
                            </div>
                            <div class="col-lg-12">
                                <label for="">Address</label>
                                <input name="message" type="text"
                                    value="{{ Auth::user()->user_more_info ? Auth::user()->user_more_info->address : ''  }}"
                                    readonly>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-input mb-30">
                                    <label>Documents (NID / Passport)</label>
                                    <input type="file" class="form-control" name="document">
                                    @error('document')
                                    <div><small class="text-danger"><strong>{{ $message }}</strong></small>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-input mb-30">
                                    <label>Personal Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                    <div><small class="text-danger"><strong>{{ $message }}</strong></small>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <button type="submit" class="thm-btn helping-one__right-btn"><i
                                        class="fas fa-arrow-circle-right"></i>Continue Now</button>
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