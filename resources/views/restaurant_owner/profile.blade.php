@extends('layouts.main-nav')

@section('content')
    <div class="container">
        <div class="page rounded-3 bg-white p-3 "
            style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Restaurant Informations</h3>
            <div class="my-5">
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 ">
                    <strong>Restaurant Name:</strong> &nbsp;</p>
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 ">
                    <strong>Restaurant Type:</strong> &nbsp;</p>
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 ">
                    <strong>Restaurant Address:</strong>&nbsp; </p>
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 ">
                    <strong>Restaurant Number:</strong>&nbsp; </p>
                <p style="display: flex;justify-content: center;" class="rounded-pill border border-success border-2 mx-5 ">
                    <strong>Restaurant Account Number:</strong>&nbsp; </p>
            </div>
        </div>

        <div class="page rounded-3 bg-white py-3 px-5 my-5"
            style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Add/Update Restaurant Information</h3>
            <div class="my-5">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Restaurant Name</label>
                        <input type="text" class="form-control " id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label" style="margin-top: 2%">Restaurant Number</label>
                        <input type="tele" class="form-control " id="number" name="number">
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label" style="margin-top: 2%">Restaurant Account Number</label>
                        <input type="text" class="form-control " id="account" name="account">
                    </div>
                    <select class="form-select " name="type" style="margin-top: 3%">
                        <option selected>Select Restaurant Type</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    <div class="mb-3">
                        <label for="adress" class="form-label" style="margin-top: 2%">Restaurant Address</label>
                        <textarea class="form-control " id="address" name="address" rows="3" style=" resize: none; "></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary my-2">Submit Profile</button>
                    <small class="mx-3 text-danger">All the users gonna see submited profile</small>
                </form>
            </div>
        </div>
    </div>
@endsection
