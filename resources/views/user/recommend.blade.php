@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2>Add Recommendation</h2>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.recommend') }}" method="post">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image_path">Image Path</label>
                    <input type="text" id="image_path" name="image_path" class="form-control">
                </div>
                <div class="form-group">
                    <label for="prices">Price</label>
                    <input type="text" id="prices" name="prices" class="form-control">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" id="type" name="type" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection