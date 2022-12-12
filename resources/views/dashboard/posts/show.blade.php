@extends('dashboard.layouts.main')
@section('container')
    <div class="container">

        <div class="row  my-3">
            <div class="col-lg-8">
                <h3 class="mb-3">{{ $post->title }}</h3>
                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my post
                </a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span>
                    Edit</a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger " onclick="return confirm('are you sure delete this data?')"><span
                            data-feather="delete"></span>Delete</button>
                    @if ($post->image)
                        <div style="max-height:350px; overflow:hidden;">
                            <img src="{{ asset('image/' . $post->image) }}" class="img-fluid mt-2"
                                alt="{{ $post->category->name }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid mt-2"
                            alt="{{ $post->category->name }}">
                    @endif
                    <article class="my-3 ">
                        <p>{!! $post->body !!}</p>

                    </article>




            </div>
        </div>

    </div>
@endsection
