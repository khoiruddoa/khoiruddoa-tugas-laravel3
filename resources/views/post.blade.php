@extends('layouts.main')
@section('container')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h3 class="mb-3">{{ $post->title }}</h3>
                writted by : <a href="/posts?author={{ $post->user->name }}">{{ $post->user->name }}</a> in <a
                    href="/posts?category={{ $post->category->slug }}"> {{ $post->category->name }}</a></p>
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



                <a href="/posts">back to post </a>
            </div>
        </div>

    </div>
@endsection
