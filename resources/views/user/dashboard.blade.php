@extends('website.layouts.app')

@section('header-links')
<link rel="stylesheet" href="{{ asset('all/user/css/style.css') }}">
<style>
h5 {
    background-color: rgb(27 28 28 / 15%);
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
                <h2 class="text-center section-title__title mb-3">
                    User Dashboard
                </h2>
                <div class="card-deck text-center">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 mb-2">
                            <div class="card bg-dark text-light">
                                <div class="card-body">
                                    <h6 class="card-title text-light">My Balance</h6>
                                    <p class="card-text">{{$total_balance}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 mb-2">
                            <div class="card bg-dark text-light">
                                <div class="card-body">
                                    <h6 class="card-title text-light">Deposit </h6>
                                    <p class="card-text">{{$total_deposit}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 mb-2">
                            <div class="card bg-dark text-light">
                                <div class="card-body">
                                    <h6 class="card-title text-light">Withdraw</h6>
                                    <p class="card-text">{{$total_withdraw}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <h5 class="text-center font-weight-normal mt-4 p-2 mb-3">
                    <b>Transaction Histry</b>
                </h5>
                <div class="d-flex justify-content-between mb-3">
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
                                @if($data->transaction_type == 1)
                                Deposit
                                @elseif($data->transaction_type == 2)
                                Withdraw
                                @endif
                            </td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->fee}}</td>
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