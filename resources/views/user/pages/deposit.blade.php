@extends('website.layouts.app')

@section('header-links')
<link rel="stylesheet" href="{{ asset('all/user/css/style.css') }}">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.modalDialog {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    opacity: 0;
    -webkit-transition: opacity 100ms ease-in;
    -moz-transition: opacity 100ms ease-in;
    transition: opacity 100ms ease-in;
    pointer-events: none;
}

.modalDialog:target {
    opacity: 1;
    pointer-events: auto;
}

.modalDialog>div {
    max-width: 500px;
    width: 50%;
    position: relative;
    margin: 10% auto;
    padding: 20px;
    border-radius: 3px;
    background: #fff;
}

.close {
    font-family: Arial, Helvetica, sans-serif;
    background: #f26d7d;
    color: #fff;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 34px;
    height: 34px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
    padding-top: 5px;
}

.close:hover {
    background: black;
}
</style>
@endsection

@section('contents')

<!--Left Section Part-->
<div class="container">
    <hr>
    <div class="row">
        @include('user.layouts.sidebar')
        <div class="col-md-8 col-lg-8">
            <div class="right-section">
                <!--Table Start-->
                <h3 class="text-center font-weight-normal mb-3">
                    Deposit
                </h3>

                <!--modals-->
                <div id="openModal-about" class="modalDialog">
                    <div>
                        <a href="#close" title="Close" class="close">X</a>
                        <h2>Deposit</h2>
                        <form action="{{route('user.deposit-store')}}" method="post" class="">
                            @csrf
                            <div class="row border bg-light">
                                <div class="col-sm-12 col-md-12 col-lg-12">

                                    <div class="mt-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon5">Deposit Amount<span
                                                        class="text-danger">*</span></span>
                                            </div>
                                            <input type="text" class="form-control" name="amount"
                                                placeholder="Deposit Amount" value="{{old('amount')}}">
                                        </div>
                                        @error('amount')
                                        <small class="text-danger mb-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="p-3 row mb-3 ml-1 d-flex flex-row justify-content-between"
                                        style="float: right;">
                                        <button type="submit" name="submit" class="btn btn-success">Deposit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <a href="#openModal-about" class="btn btn-success">Add</a>
                    <input class="" id='search-box' placeholder='Search'>
                </div>

                <table class="table mt-0 table-striped border">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                Deposit
                            </td>
                            <td>{{$data->amount}}</td>
                            <td>0.00</td>
                            <td>{{date('d M,Y', strtotime($data->date))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!--Left Section End-->


@endsection

@section('footer-links')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script>
(function() {
    var showResults;
    $('#search-box').keyup(function() {
        var searchText;
        searchText = $('#search-box').val();
        return showResults(searchText);
    });
    showResults = function(searchText) {
        $('tbody tr').hide();
        return $('tbody tr:Contains(' + searchText + ')').show();
    };
    jQuery.expr[':'].Contains = jQuery.expr.createPseudo(function(arg) {
        return function(elem) {
            return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
}.call(this));
</script>
@endsection