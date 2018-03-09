@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @if(Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <span class="badge pull-left" style="margin-right:8px;">{{ $product['qty'] }}</span>
                            <strong>{{ $product['item']['product_name'] }}</strong>
                            <span class="label label-success pull-right" style="margin-left:8px;font-size:16px;">${{ $product['item']['prices'] }}</span>
                               <button type="button" class="pull-right">
                                   <a class="label label-warning" href="{{ route('products.reduceByOne', ['id' => $product['item']['id']]) }}">Reduce By One</a>
                               </button>
                               <button type="button" class="pull-right">
                                    <a class="label label-danger" href="{{ route('products.remove', ['id' => $product['item']['id']]) }}">Delete Item</a>
                               </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
               <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2 style="text-align:center;">No Items in Cart</h2>
            </div>
        </div>
    @endif
@endsection