@extends('layouts.admin-nav')
@section('content')
    <div class="container">
        @if ($error != null)
            <div class="alert alert-success my-3" role="alert" style="margin:auto; width: 50%;">
                <strong class="d-flex justify-content-center">{{ $error }}</strong>
            </div>
        @endif
        @if ($name != null)
            <div class="page rounded-3 bg-white py-3 px-4 mb-5"
                style="margin:auto; width: 50%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h3 class="text-center">Edit Restaurant Category</h3>
                <div class="my-5">
                    <form method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Category Name</label>
                            <input value="{{ $name }}" type="text" class="form-control " id="name"
                                name="name">
                        </div>
                        <button value="{{ $id }}" name="update" type="submit"
                            class="btn btn-primary my-2">Update</button>
                    </form>
                </div>
            </div>
        @else
            <div class="page rounded-3 bg-white py-3 px-4 mb-5"
                style="margin:auto; width: 50%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h3 class="text-center">Add New Restaurant Category</h3>
                <div class="my-5">
                    <form method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Category Name</label>
                            <input type="text" class="form-control " id="name" name="name" required>
                        </div>
                        <button name="create" type="submit" class="btn btn-primary my-2">Create</button>
                    </form>
                </div>
            </div>
        @endif
        <div class="page rounded-3 bg-white p-3 "
            style="margin:auto; width: 50%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Existed Restaurant Categories</h3>
            <div class="my-5">
                @if (count($restaurant_categories) == 0)
                    <h4 class="text-center">There is no restaurant category...</h4>
                @endif
                <table class="table">
                    <tbody>
                        @foreach ($restaurant_categories as $key => $restaurant_category)
                            <tr>
                                <th scope="row">
                                    @php $row_number = $key; @endphp
                                    {{ ++$row_number }}
                                </th>
                                <td>{{ $restaurant_category->name }}</td>
                                <td class="d-flex flex-row-reverse">
                                    <form action="" method="post" class="d-inline p-2">
                                        @csrf
                                        <button name="delete" value="{{ $restaurant_category->id }}" type="submit"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                    <form action="" method="post" class="d-inline p-2">
                                        @csrf
                                        <button name="edit" value="{{ $restaurant_category->id }}" type="submit"
                                            class="btn btn-warning">Edit</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
