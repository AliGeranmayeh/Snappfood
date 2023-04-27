@extends('layouts.admin-nav')
@section('content')
    <div class="container">
        <div class="page rounded-3 bg-white p-3 "
            style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Existed Food Categories</h3>
            <div class="my-5">
                <table class="table">
                    <tbody>
                        @foreach ($food_categories as $key => $food_category)
                            <tr>
                                <th scope="row">
                                    @php $row_number = $key; @endphp
                                    {{ $row_number++ }}
                                </th>
                                <td>{{ $food_category->name }}</td>
                                <form action="" method="post">
                                    @csrf
                                    <td><button name="delete" value="{{ $food_category->id }}" type="submit"
                                            class="btn btn-danger">Delete</button></td>
                                    <td><button name="edit" value="{{ $food_category->id }}" type="submit"
                                            class="btn btn-warning">Edit</button></td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($name != null)
            <div class="page rounded-3 bg-white py-3 px-5 my-5"
                style="margin:auto; width: 80%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <h3 class="text-center">Edit Food Category</h3>
                <div class="my-5">
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Food Category Name</label>
                            <input type="text" class="form-control " id="name" name="name">
                        </div>
                        <button name="update" type="submit" class="btn btn-primary my-2">Update</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
