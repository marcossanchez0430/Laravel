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
        <div class="col-md-9">
            <div class="panel panel-default">
                 <div class="panel-heading">{{ Auth::users()->name }}</div>
                    <div class="panel panel-body">
                        <div class="col-sm-12 col-md-12">
                            @foreach($friends as $friend)
                            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                <div class="col-md-2 pull-left">
                                    <img  src="data:image/png;base64,{{chunk_split(base64_encode(Auth::user()->picture))}}">
                                </div>
                                    <div class="col-md-7 pull-left">
                                        <h2>Hi my name is {{ Auth::user()->name }}</h2>
                                    </div>
                                    <div class="col-md-3 pull-right">

                                        <?php
                                        $check = DB::table('Friends')
                                        ->where('user_requested', '=', $friend->id)
                                        ->where('requester', '=', Auth::user()->id)
                                        ->first();

                                        if($check == '') {

                                        ?>
                                        <p><a href="" class="btn btn-success">Add Friend</a></p>
                                    <?php }
                                    else { ?>
                                         <p>Request Sent</p>
                                            <?php } ?>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection