@extends('layouts.main-nav')

@section('content')
    </p>
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center my-1 P-1" role="alert" style="margin:auto; width: 80%;">
                 {{ $error }}
            </div>
            @endforeach
        @endif
        <div class="page rounded-3 bg-white py-3 px-5 "
            style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Update Restaurant Information</h3>
            <div class="my-2">
                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Restaurant Name</label>
                        <input type="text" class="form-control " id="name" name="name"
                            value="{{ $restaurant->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label" style="margin-top: 2%">Restaurant Phone</label>
                        <input type="tele" class="form-control " id="number" name="phone " placeholder="8 Digits"
                            value="{{ $restaurant->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label" style="margin-top: 2%">Restaurant Bank Account </label>
                        <input type="text" class="form-control " id="account" name="account" placeholder="16 Digits"
                            value="{{ $restaurant->account }}">
                    </div>
                    <select class="form-select " name="type" style="margin-top: 3%" required>
                        <option selected>Select Restaurant Type</option>
                        @foreach ($restaurant_categories as $restaurant_category)
                            <option value="{{ $restaurant_category->id }}"
                                @if ($restaurant_category->id == $restaurant_category_id) selected @endif>
                                {{ $restaurant_category->name }}</option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <label for="adress" class="form-label" style="margin-top: 2%">Restaurant Address</label>
                        <textarea class="form-control " id="address" name="address" rows="3" style=" resize: none; ">{{ $restaurant->address }}</textarea>
                    </div>
                    <button name="update" type="submit" class="btn btn-primary my-2">Update Restaurant
                        Profile</button>
                    <small class="mx-3 text-danger">All the users gonna see your updated profile</small>
                </form>
            </div>
        </div>
    </div>
@endsection
