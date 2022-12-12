@extends('layouts.main')
@section('container')
    <div class="d-flex justify-content-center mt-4">
        <h1>Our Product</h1>
    </div>
    @if ($product->count())
        <div class="d-flex justify-content-center mt-4">

            <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">

                <div class="card gap-1" style="width: 18rem;">
                    <img src="{{ $product->photo }}" width="200px" height="200px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Rp. {{ $product->price }}</p>
                        <p class="card-text">Stock : {{ $product->stock }}</p>
                        <a class="btn btn-primary" href="/products" role="button">All Products</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-center fs-4">No Product.</p>
    @endif
@endsection
