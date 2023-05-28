@extends('layouts.main-nav')

@section('content')
    </p>
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger text-center my-2" role="alert" style="margin:auto; width: 80%;">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="page rounded-3 bg-white py-3 px-5 "
            style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Add New Food</h3>
            <div class="my-2">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image">
                      </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control " id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" style="margin-top: 2%">Price</label>
                        <input type="text" class="form-control " id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="materials" class="form-label" style="margin-top: 2%">Materials</label>
                        <input type="text" class="form-control " id="materials" name="materials">
                    </div>
                    <select class="form-select " name="type" style="margin-top: 3%" required>
                        <option selected>Select Food Type</option>
                        @foreach ($food_categories as $food_category)
                            <option value="{{ $food_category->id }}">
                                {{ $food_category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select " name="discount" style="margin-top: 3%" required>
                        <option value="null" selected>Select Discount</option>
                        @foreach ($discounts as $discount)
                            <option value="{{ $discount->id }}">
                                {{$discount->name}}&nbsp;with&nbsp;{{ $discount->percentage }}%&nbsp;off
                            </option>
                        @endforeach
                    </select>

                    <button name="update" type="submit" class="btn btn-primary my-2">Add Food</button>
                    <small class="mx-3 text-danger">All the users gonna see your added food</small>
                </form>
            </div>
        </div>
    </div>
@endsection
