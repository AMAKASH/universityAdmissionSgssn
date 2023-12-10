@extends('layouts.app2')

@section('title')
    Discussion Forum | {{ config('app.name', 'Laravel') }}
@endsection

@section('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
@endsection
@section('content')
    <main class="container mt-5">
        <div class="row mb-2">
            <form class="row g-2 justify-content-center border rounded mb-4  p-4" method="POST"
                action="{{ route('discussion.create') }}">
                <div class="row g-3">
                    @csrf

                    <div class="col-md-12">
                        <h2 class="text-primary">Post Discussion</h2>
                    </div>
                    <div class="col-md-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Title of the Disccusion" required>

                    </div>
                    <div class="col-md-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category"
                            placeholder="category of the Disccusion" required>

                    </div>
                    <div class="col-md-12">
                        <label for="content" class="form-label">Discussion</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Enter Discussion Content.." rows="5"
                            required></textarea>
                    </div>

                    <input type="submit" class="btn btn-primary rounded col-md-6 mx-auto" value="Post Discussion" />
                </div>
            </form>
            @foreach ($blogs as $blog)
                <div class="col-md-12">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary-emphasis">{{ $blog->category }}</strong>
                            <h3 class="mb-2">{{ $blog->title }}</h3>
                            <div class="mb-4 text-body-secondary">{{ $blog->user->name }}</div>
                            <p class="card-text mb-auto">{{ substr($blog->content, 0, 250) . '....' }}<br>
                                <a href="{{ route('discussion.show', $blog->id) }}"
                                    class="icon-link gap-1 icon-link-hover stretched-link">
                                    Continue reading ....

                                </a>


                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
@section('scripts')
@endsection
