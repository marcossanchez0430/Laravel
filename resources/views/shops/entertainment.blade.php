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
    <div class="dropdown pull-right">
        <button style="background-color:grey;" class="btn btn-default dropdown-toggle" role="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ route('products.browse') }}">All</a></li>
            <li><a href="{{ route('food') }}">Food</a></li>
            <li><a href="{{ route('clothes') }}">Clothes</a></li>
            <li><a href="{{ route('entertainment') }}">Entertainment</a></li>
            <li><a href="{{ route('etc') }}">Etc.</a></li>
        </ul>
    </div>
    @foreach($browses->chunk(3) as $browseChunk)
        <div style="margin-top:5%;"class="row">
            @foreach($browseChunk as $browse)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $browse->image_path }}" alt="...">
                        <div class="caption">
                            <h3 style="text-align:center;">{{ $browse->product_name }}</h3>
                            <p class="description" style="text-align:center;">{{ $browse->description }}</p>
                            <div class="clearfix">
                                <div class="price" style="text-align:center;">${{ $browse->prices }}</div>
                                <div class="name"><h4 class="description" style="text-align:center;">Recommended by <a href="{{ route('profiles', ['id' => $browse->full_name]) }}">{{ $browse->full_name }}</a></h4></div>
                                <a href="{{ route('products.addToCart', ['id' => $browse->id]) }}" class="btn btn-success pull-right" role="button">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection