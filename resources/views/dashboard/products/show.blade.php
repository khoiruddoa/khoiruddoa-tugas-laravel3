@extends('dashboard.layouts.main')
@section('container')
    <div class="container">

        <div class="row  my-3">
            <div class="col-lg-8">
                <h3 class="mb-3">{{ $product->name }}</h3>
                <a href="/dashboard/products" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my
                    product
                </a>
                <a href="/dashboard/products/{{ $product->id }}/edit" class="btn btn-warning"><span
                        data-feather="edit"></span>
                    Edit</a>
                <form action="/dashboard/products/{{ $product->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger " onclick="return confirm('are you sure delete this data?')"><span
                            data-feather="delete"></span>Delete</button>
                    @if ($product->photo)
                        <div style="max-height:350px; overflow:hidden;">
                            <img src="{{ asset($product->photo) }}" class="img-fluid mt-2" alt="">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $product->name }}" class="img-fluid mt-2"
                            alt="">
                    @endif
                    <article class="my-3 ">
                        <p>{!! $product->description !!}</p>
                        <p> Stock {{ $product->stock }}</p>
                        <p> Harga {{ $product->price }}</p>



                    </article>




            </div>
        </div>

    </div>
@endsection
