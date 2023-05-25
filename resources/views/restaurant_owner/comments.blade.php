@extends('layouts.main-nav')
@section('css-link')
    <style>
        .text {
            padding: 1%;
            width: 100%;
        }

        article {
            width: 90%;
            margin: auto
        }

        .grid-container {
            display: grid;
            grid-template-columns: 3fr 2fr;
            grid-gap: 20px;
        }

        .reply-form {
            height: 10em;
            display: flex;
            align-items: center;
            justify-content: center
        }

    </style>
@endsection

@section('content')
    @if (count($delete_request_comments) == 0 && count($confirmed_comments) == 0)
        <h2 class="text-center text-white">No comment is available...</h2>
    @endif
    <div class="grid-container container grid my-5">
        <div class="comments">
            @foreach ($delete_request_comments as $comment)
                <article class="rounded my-3 border border-3 border-danger" style="background-color: #ffdde2;">
                    <div class="text">
                        <h5><b>User: {{ $comment['user'] }}</b></h5>
                        <div>
                            <p style="padding:0 3%">{{ $comment['comment'] }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
            <div style="width:100%;margin:6%"></div>
            @foreach ($confirmed_comments as $comment)
                <article class="rounded my-3" style="background-color: white">
                    <div class="text">
                        <h5><b>User: {{ $comment['user'] }}</b></h5>
                        <div>
                            <p style="padding:0 3%">{{ $comment['comment'] }}</p>
                            <form action="" method="post" class="d-flex justify-content-center">
                                @csrf
                                <button name="delete" type="button" class="btn btn-danger m-1  w-25 "><a
                                        class="text-white" style="text-decoration: none"
                                        href="comments/delete_request/{{ $comment['id'] }}">Delete Request</a></button>
                                <button type="submit" name="reply"class="btn btn-info m-1  w-25" value="{{ $comment['id'] }}">Reply</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="reply-form " style="padding: 50% 0">
            <div class="reply rounded p-2" style="background-color: rgb(243, 243, 243);width:90%">
                @if ($replied_comment != null)
                <p class="text-secondary py-3">Replied Comment: {{$replied_comment->comment}}</p>
                <form action="" method="put">
                    @csrf
                    <div class="mb-3">
                        <label for="reply" class="form-label">Reply</label>
                        <textarea class="form-control" id="reply" rows="3" name="reply"></textarea>
                        <button name="reply" type="submit" class="btn btn-primary my-2" 
                        value="{{$replied_comment->id}}">Reply</button>
                    </div>
                </form>
                @else
                <form action="" method="put">
                    @csrf
                    <div class="mb-3">
                        <label for="reply" class="form-label">Reply</label>
                        <textarea class="form-control" id="reply" rows="3" name="reply"></textarea>
                        <button name="reply" type="submit" class="btn btn-primary my-2" 
                        value="null">Reply</button>
                    </div>
                </form>
                @endif
                

            </div>
        </div>

    </div>
@endsection
