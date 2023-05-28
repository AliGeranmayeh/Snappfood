@extends('layouts.main-nav')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert" style="margin:auto; width: 80%;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

            </div>
        @elseif ($error != null)
            <div style="margin:auto; width: 80%;" class="alert alert-danger text-center" role="alert">
                <strong>{{ $error }}</strong>
            </div>
        @endif
        @if ($restaurant != null)
            <div class="page rounded-3 bg-white p-3 "
                style="margin:10% auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h3 class="text-center">Restaurant Informations</h3>
                <div class="my-5">
                    <p style="display: flex;justify-content: center;border-color:#005cb8 !important     "
                        class="rounded-pill border border-success border-2 mx-5 ">
                        <strong>Restaurant Name:</strong> &nbsp;{{$restaurant->name}}
                    </p>
                    <p style="display: flex;justify-content: center;border-color:#005cb8 !important     "
                        class="rounded-pill border border-success border-2 mx-5 ">
                        <strong>Restaurant Type:</strong> &nbsp;{{$category}}
                    </p>
                    <p style="display: flex;justify-content: center;border-color:#005cb8 !important     "
                        class="rounded-pill border border-success border-2 mx-5 ">
                        <strong>Restaurant Address:</strong>&nbsp;{{$restaurant->address}}
                    </p>
                    <p style="display: flex;justify-content: center;border-color:#005cb8 !important"
                        class="rounded-pill border border-2 mx-5 " >
                        <strong>Restaurant Number:</strong>&nbsp;{{$restaurant->phone}}
                    </p>
                    <p style="display: flex;justify-content: center;border-color:#005cb8 !important     "
                        class="rounded-pill border border-success border-2 mx-5 ">
                        <strong>Restaurant Account Number:</strong>&nbsp;{{$restaurant->account}}
                    </p>
                    <div  style="display: flex;justify-content: center;">
                        <a style="width: 90%" href="{{route('edit-restaurant-profile')}}" class="btn btn-primary"> Update Your
                            Restaurant Profile</a>
                    </div>

                </div>

            </div>
        @else
            <div class="page rounded-3 bg-white py-3 px-5 my-5"
                style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h3 class="text-center">Add Restaurant Information</h3>
                <div class="my-5">
                    <form method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Name</label>
                            <input type="text" class="form-control " id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label" style="margin-top: 2%">Restaurant Phone</label>
                            <input type="tele" class="form-control " id="number" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="account" class="form-label" style="margin-top: 2%">Restaurant Account
                                Number</label>
                            <input type="text" class="form-control " id="account" name="account">
                        </div>
                        <select class="form-select " name="type" style="margin-top: 3%" required>
                            <option selected>Select Restaurant Type</option>
                            @foreach ($restaurant_categories as $restaurant_category)
                                <option value="{{ $restaurant_category->id }}">{{ $restaurant_category->name }}</option>
                            @endforeach
                        </select>
                        <div class="mb-3">
                            <label for="adress" class="form-label" style="margin-top: 2%">Restaurant Address</label>
                            <textarea class="form-control " id="address" name="address" rows="3" style=" resize: none; "></textarea>
                        </div>
                        <button name="create" type="submit" class="btn btn-primary my-2">Create Restaurant
                            Profile</button>
                        <small class="mx-3 text-danger">All the users gonna see submited profile</small>
                    </form>
                </div>
            </div>
        @endif


    </div>
@endsection
