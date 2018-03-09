@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @if(Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <h1 style="text-align: center; font-family: Aria; font-size: 48px;">Welcome To RecBuy</h1>
        <img style="padding-left: 20%; padding-top: 5%;" src="https://www.thefairtradepractice.co.uk/sites/all/themes/fair_trade/images/recommend6.png">
    </div>

@endsection