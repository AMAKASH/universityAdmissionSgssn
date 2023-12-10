@extends('layouts.app2')

@section('title')
    {{ $blog->title }} | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
    <style>
        .bdge {
            height: 21px;
            background-color: orange;
            color: #fff;
            font-size: 11px;
            padding: 8px;
            border-radius: 4px;
            line-height: 3px;
        }

        .comments {
            text-decoration: underline;
            text-underline-position: under;
            cursor: pointer;
        }

        .dot {
            height: 7px;
            width: 7px;
            margin-top: 3px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }

        .hit-voting:hover {
            color: blue;
        }

        .hit-voting {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <main class="container mt-5">
        <div class="row mb-2">

            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">{{ $blog->category }}</strong>
                        <h3 class="mb-2">{{ $blog->title }}</h3>
                        <div class="mb-4 text-body-secondary">{{ $blog->created_at }}</div>
                        <p class="card-text mb-auto">{!! str_replace("\n", '<br>', $blog->content) !!}<br>
                    </div>
                    @if ($blog->user_id == auth()->user()->id)
                        <div class="mb-4 ms-4">
                            <a href="{{ route('discussion.delete', $blog->id) }}" class="text-danger">Delete</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-8 border rounded ms-5 pb-3">
                <div>
                    <p class="mt-4 ms-2"><strong id="comment_prompt">Comment on the blog post:</strong></p>
                    <form method="POST" action="{{ route('comment-add') }}"
                        class="d-flex flex-row add-comment-section mt-1 mb-4">
                        @csrf
                        <input type="number" name="blog_id" id="blog_id" value="{{ $blog->id }}" hidden>
                        <input type="number" name="comment_id" id="comment_id" value="0"hidden>
                        <img class="img-fluid img-responsive rounded-circle me-2"
                            src="{{ asset('storage/' . auth()->user()->image_path) }}" alt="Profile_pic" width="38">
                        <input type="text" name="comment" class="form-control me-3" placeholder="Add comment"><button
                            class="btn btn-primary" type="submit">Comment</button>
                    </form>
                </div>
                @foreach ($blog->comments as $comment)
                    @if ($comment->reply_to != 0)
                        @continue
                    @endif
                    <div class="commented-section mt-3">
                        <div class="d-flex flex-row align-items-center commented-user">
                            <img class="img-fluid img-responsive rounded-circle me-2" alt="Profile_pic"
                                src="{{ asset('storage/' . $comment->user->image_path) }}" width="30">
                            <a href="{{ route('profile.show', $comment->user->id) }}" class="me-2">
                                <h5>{{ $comment->user->name }}</h5>
                            </a>
                        </div>
                        <div class="comment-text-sm ms-5">
                            <span>{!! str_replace('\n', '<br>', $comment->content) !!}</span>
                        </div>

                        <div class="reply-section vertical-alignment-center ms-5">
                            <div class="d-flex flex-row align-items-center voting-icons">
                                <a>
                                    <strong class=" mt-0"
                                        onclick="clickedReply({{ $comment->id }},'{{ $comment->user->name }}')">
                                        Reply
                                    </strong></a>
                                @if ($comment->user_id == auth()->user()->id)
                                    <a href="{{ route('comment-delete', $comment->id) }}"><strong
                                            class="ms-2 mt-1 text-danger">
                                            Delete </strong>
                                    </a>
                                @endif
                            </div>
                            @if (count($comment->replies) != 0)
                                <div><strong>Replies:</strong></div>
                            @endif
                            @foreach ($comment->replies as $reply)
                                <div class="commented-section mt-3">
                                    <div class="d-flex flex-row align-items-center commented-user">
                                        <img class="img-fluid img-responsive rounded-circle me-2" alt="Profile_pic"
                                            src="{{ asset('storage/' . $reply->user->image_path) }}" width="30">
                                        <a href="{{ route('profile.show', $reply->user->id) }}" class="me-2">
                                            <h5>{{ $reply->user->name }}</h5>
                                        </a>
                                    </div>
                                    <div class="comment-text-sm ms-5">
                                        <span>{!! str_replace('\n', '<br>', $reply->content) !!}</span>
                                    </div>
                                    <div class="reply-section vertical-alignment-center ms-5">
                                        <div class="d-flex flex-row align-items-center voting-icons">
                                            @if ($reply->user_id == auth()->user()->id)
                                                <a href="{{ route('comment-delete', $reply->id) }}"><strong
                                                        class=" mt-1 text-danger">
                                                        Delete </strong>
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


            </div>


        </div>
    </main>
@endsection
@section('scripts')
    <script>
        function clickedReply(comment_id, name) {
            console.log("Clicked Replied", comment_id, name);
            document.getElementById('comment_id').value = comment_id;
            document.getElementById('comment_prompt').innerHTML = "Replying to " + name;
        }
    </script>
@endsection
