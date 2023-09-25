@php
$shop_info = shop_info();
@endphp
@extends('website.layouts.app')

@section('header-links')

@endsection

@section('contents')

@include('website.layouts.breadcrumb')

@include('website.section.projects')

@endsection

@section('footer-links')

@endsection