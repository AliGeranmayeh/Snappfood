@extends('layouts.admin-nav')
@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger text-center my-3" role="alert" style="margin:auto; width: 50%;">
                    <strong>{{ $error }}</strong>
                </div>
            @endforeach
        @elseif ($error != null)
            <div style="margin:auto; width: 50%;" class="alert alert-danger text-center my-3" role="alert">
                <strong>{{ $error }}</strong>
            </div>
        @endif
        <div class="page rounded-3 bg-white p-3 "
            style="margin:auto; width: 50%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Existed Discounts</h3>
            <div class="my-5">
                @if (count($discounts) == 0)
                    <h4 class="text-center">There is no discount...</h4>
                @endif
                <table class="table">
                    <tbody>
                        @foreach ($discounts as $key => $discount)
                            @if ($discount->user_id == Auth::user()->id)
                                <tr class="table-info">
                                    <th scope="row">
                                        @php $row_number = $key;$row_number+=1; @endphp
                                        {{ $row_number }}
                                    </th>
                                    <td>{{ $discount->name }}</td>
                                    <td>{{ $discount->percentage }}%</td>
                                    <td class="d-flex flex-row-reverse">
                                        <form action="" method="post" class="d-inline p-2">
                                            @csrf
                                            <button name="delete" value="{{ $discount->id }}" type="submit"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th scope="row">
                                        @php $row_number = $key;$row_number+=1; @endphp
                                        {{ $row_number}}
                                    </th>
                                    <td>{{ $discount->name }}</td>
                                    <td>{{ $discount->percentage }}%</td>
                                    <td class="d-flex flex-row-reverse">
                                        <form action="" method="post" class="d-inline p-2">
                                            @csrf
                                            <button name="delete" value="{{ $discount->id }}" type="submit"
                                                class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="page rounded-3 bg-white py-3 px-4 my-5"
            style="margin:auto; width: 50%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <h3 class="text-center">Add New Discount</h3>
            <div class="my-5">
                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Discount Name</label>
                        <input type="text" class="form-control " id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="percentage" class="form-label">Discount Percentage</label>
                        <input type="text" class="form-control " id="percentage" name="percentage" required>
                    </div>
                    <button name="create" type="submit" class="btn btn-primary my-2">Create</button>
                </form>
            </div>
        </div>

    </div>
@endsection
