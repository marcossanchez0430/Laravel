@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-10 cold-md-offset-2">
        <h1 style="margin-left:5%;">Welcome {{ Auth::user()->name }}</h1>
        <hr>
        <h2 style="text-align:center;" style="margin-left:30%;">My Recommendations</h2>
        <hr>
            <div class="row" style="margin-left:5%;">
                @foreach($recommends as $recommend)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="{{ $recommend->image_path }}" alt="...">
                            <div class="caption">
                                <h3 style="text-align:center;">{{ $recommend->product_name }}</h3>
                                <p class="description" style="text-align:center;">{{ $recommend->description }}</p>
                                <div class="clearfix">
                                    <div class="price" style="text-align:center;">${{ $recommend->prices }}</div>
                                    <div class="name"><h4 class="description" style="text-align:center;">Recommended by {{ $recommend->full_name }}</h4></div>
                                    <a href="{{ route('products.addToCart', ['id' => $recommend->id]) }}" class="btn btn-success pull-right" role="button">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        <h2 style="text-align:center;">My Orders</h2>
        @foreach($orders as $order)
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($order->cart->items as $item)
                    <li class="list-group-item">
                        <span class="badge">{{ $item['price'] }} $</span>
                        {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="panel-footer">
                <strong>Total Price: {{ $order->cart->totalPrice }}</strong>
            </div>
        </div>
            @endforeach
    </div>
</div>
@endsection