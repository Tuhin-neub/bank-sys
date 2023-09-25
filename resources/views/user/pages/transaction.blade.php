@extends('website.layouts.app')

@section('header-links')
<link rel="stylesheet" href="{{ asset('all/user/css/style.css') }}">

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
                    Transaction
                </h3>
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