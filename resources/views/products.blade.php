@extends('layouts.main')
@section('container')
    <div class="d-flex justify-content-center mt-4">
        <h1>Our Product</h1>
    </div>
    @if ($products->count())
        <div class="d-flex justify-content-center mt-4">

            <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">
                @foreach ($products as $product)
                    <div class="card gap-1" style="width: 18rem;">
                        <img src="{{ $product->photo }}" width="200px" height="200px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp. {{ $product->price }}</p>
                            <a class="btn btn-primary" href="/products/{{ $product->id }}" role="button">Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No Product.</p>
    @endif
    <div class="d-flex justify-content-center mt-3 align-items-center">
        {{ $products->links() }}
    </div>

@endsection
