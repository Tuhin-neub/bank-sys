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
                    <h1>Donate Now</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- title section end -->

<!-- Start Donate page area -->
<section class="donate-page-area pt-90 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="donate-content">
                    <div class="donate-form-container">
                        <div class="donate-form-title">
                            <h3>Donation Details</h3>
                        </div>
                        <div class="donation-form quick-donation-section donate-page">
                            <form action="#" class="form">
                                <div class="donate-amount">
                                    <p>How much would you like to donate?</p>
                                    <div class="donate-list">
                                        <div class="box">
                                            <input type="radio" id="c1" name="c1">
                                            <label for="c1"><span class="check-icon"></span> <span
                                                    class="amount">$100</span></label>
                                        </div>
                                        <div class="box">
                                            <input type="radio" id="c2" name="c1">
                                            <label for="c2"><span class="check-icon"></span> <span
                                                    class="amount">$200</span></label>
                                        </div>
                                        <div class="box active">
                                            <input type="radio" id="c3" name="c1" checked="">
                                            <label for="c3"><span class="check-icon"></span> <span
                                                    class="amount">$500</span></label>
                                        </div>
                                    </div>
                                    <div class="enter-amount">
                                        <input type="text" placeholder="-- Enter Amount --">
                                    </div>
                                </div>
                                <div class="tg-donetship">
                                    <p>Would you like to make regular donations?</p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input mb-30">
                                                <label>First Name</label>
                                                <input type="text" name="first_name" placeholder="Ex: Join">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input mb-30">
                                                <label>Last Name</label>
                                                <input type="text" name="last_name" placeholder="Ex: Doe">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input mb-30">
                                                <label>Phone Number</label>
                                                <input type="text" name="night_phone_a" placeholder="Ex: 03 2685987">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input mb-30">
                                                <label>Email </label>
                                                <input type="text" name="email" placeholder="Ex: jdoe@zyzzyu.com">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single-input mb-30">
                                                <label>Address</label>
                                                <textarea name="address1" placeholder="Address Here"
                                                    class="border"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single-input mb-30">
                                                <div class="form-group">
                                                    <label for="training_session">
                                                        Donation For
                                                    </label>
                                                    <select multiple class="form-control" id="training_session"
                                                        style="padding: 0px;">
                                                        <option class="p-2 border">Current Project 01</option>
                                                        <option class="p-2 border">Upcoming Project 01</option>
                                                        <option class="p-2 border">Current Project 02</option>
                                                        <option class="p-2 border">Upcoming Project 02</option>
                                                        <option class="p-2 border">Current Project 03</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="donate-btn" style="display: flex; justify-content: space-between;">
                                    <button type="submit">Donate</button>
                                    <button type="Sign In" style="background-color: rgb(0, 16, 44);">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Donate page area -->




@endsection

@section('footer-links')

@endsection