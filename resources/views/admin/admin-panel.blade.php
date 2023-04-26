@extends('layouts.admin-nav')


@section('content')
    <div class="container">
        <div class="row justify-content-md-center my-5 " style="height: 33%">
            <div class="col col-lg-10 bg-white p-3 rounded"
            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <p>users </p>
                <a href="{{ route('users') }}" class="btn btn-primary">More</a>
            </div>
        </div>
        <div class="row justify-content-md-center my-5" style="height: 33%">
            <div class="col col-lg-10 bg-white p-3 rounded"
            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <p>resturants </p>
                <a href="#" class="btn btn-primary">More</a>
            </div>

        </div>
        <div class="row justify-content-md-center" style="height: 33%">
            <div class="col col-lg-3 bg-white mx-4 p-3 rounded"
            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <p>discounts </p>
                <a href="#" class="btn btn-primary">More</a>
            </div>
            <div class="col col-lg-3 bg-white mx-4 p-3 rounded"
            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <p>food categories </p>
                <a href="#" class="btn btn-primary">More</a>
            </div>
            <div class="col col-lg-3 bg-white mx-4 p-3 rounded"
            style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <p>resturant categories</p>
                <a href="#" class="btn btn-primary">More</a>
            </div>
        </div>
    </div>
@endsection
