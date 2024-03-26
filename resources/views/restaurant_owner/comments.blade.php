@extends('layouts.main-nav')
@section('css-link')
    <style>
        article {
            width: 90%;
            margin: auto
        }

        .grid-container {
            display: grid;
            grid-template-columns: 3fr 2fr;
            grid-gap: 20px;
        }
    </style>
@endsection

@section('content')

    <form class="my-5" style="width: 70%;margin:auto">
        @csrf
        <select class="form-select d-inline" aria-label="Default select example" style="width: 80%;margin:auto"
            name="foods_filter">
            <option value='0' selected>Foods Filter</option>
            @foreach ($restaurant_foods as $restaurant_food)
                <option value="{{ $restaurant_food->id }}">{{ $restaurant_food->name }}</option>
            @endforeach
        </select>
        <button style="width: 7%;margin:auto" class="btn btn-outline-primary mx-3" type="submit">Filter</button>

    </form>
    @if (count($delete_request_comments) == 0 && count($confirmed_comments) == 0)
        <h2 class="text-center my-5">No comment is available...</h2>
    @endif
    <div class="row container grid my-5">
        <div class="col">
            @foreach ($delete_request_comments as $comment)
                <article class="rounded py-3 border border-3 border-danger" style="background-color: #ffdde2;">
                    <div class="mx-2" >
                        <h5><b>User: {{ $comment['user'] }}</b></h5>
                        <div>
                            <p style="padding:0 3%">{{ $comment['comment'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
            <div style="width:100%;margin:6%"></div>
            @foreach ($confirmed_comments as $comment)
                <article class="rounded my-3 p-2" style="background-color: white">
                    <div class="mx-2">
                        <h5 class="mt-1"><b>User: {{ $comment['user'] }}</b></h5>
                        <div>
                            <p style="padding:0 3%">{{ $comment['comment'] }}</p>
                            @if ($comment['reply'] != null)
                                <h5 style="color: rgb(48, 173, 69); padding:0 5%"><b>answer:
                                        {{ $comment['reply']->comment }}</b></h5>
                            @else
                                <div class="d-flex justify-content-center">
                                    @csrf
                                   {{-- @php
                                       dd( $comment['id'],$replied_comment->id);
                                   @endphp --}}
                                    @if ($replied_comment =='' || $comment['id'] != $replied_comment->id)
                                    <a
                                        class="text-white m-1  w-25" style="text-decoration: none" 
                                        href="{{ route('comments.delete.request', ['comment_id' => $comment['id']]) }}"><button name="delete" type="button" class="btn btn-danger  w-100">Delete
                                        Request</button></a>
                                    @endif
                                    <a class="text-white m-1 w-25" style="text-decoration: none"
                                            href="{{ route('comments.confirmed.reply.select', ['comment_id' => $comment['id']]) }}">
                                    <button name="reply" type="button" class="btn btn-info w-100">Reply</button></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        @if (count($delete_request_comments) != 0 || count($confirmed_comments) != 0)
            <div class="reply-form col d-flex justify-content-center " style="margin: 10% 0">
                <div class="reply rounded p-2 w-25 " style="background-color: rgb(243, 243, 243);position:fixed">
                    @if ($replied_comment != '')
                        <div class="form-group">
                            <label for="replied_comment">Replied Comment</label>
                            <input type="text" class="form-control text-secondary fw-bold" id="replied_comment"
                                value=" {{ $replied_comment->comment }}" disabled style="font-size: 16px">
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="reply" class="form-label">Reply</label>
                                <textarea style=" resize: none ;" class="form-control" id="reply" rows="3" name="reply"></textarea>
                                <button name="reply_btn" type="submit" class="btn btn-primary my-2"
                                    value="{{ $replied_comment->id }}">Reply</button>
                            </div>
                        </form>
                    @else
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="reply" class="form-label">Reply</label>
                                <textarea style=" resize: none ;" class="form-control" id="reply" rows="3" name="reply"></textarea>
                                <button name="reply" type="submit" class="btn btn-primary my-2"
                                    value="null">Reply</button>
                            </div>
                        </form>
                    @endif
                </div>

            </div>
        @endif
    </div>
@endsection
