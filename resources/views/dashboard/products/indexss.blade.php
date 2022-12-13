@extends('../layouts.main')
@section('container')
    <div class="d-flex justify-content-center mt-4">
        <h1>Our Product</h1>
    </div>
    <div> <a class="btn btn-primary" href="/product/create" role="button">Create Product</a></div>
    @if ($products->count())
        <div class="d-flex justify-content-center mt-4">
            <div class="col-8 d-flex justify-content-center gap-3">
                @foreach ($products as $product)
                    <div class="card gap-1" style="width: 18rem;">
                        <img src="{{ $product->photo }}" width="200px" height="200px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->price }}</p>
                            <p class="card-text">{{ $product->stock }}</p>
                            <a href="#"><button class="badge bg-primary border-0">Detail</button></a>

                            <a href="/product/{{ $product->id }}/edit"><button
                                    class="badge bg-primary border-0">Edit</button></a>
                            <form action="/product/{{ $product->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-primary border-0"
                                    onclick="return confirm('are you sure delete this data?')">Delete</button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No Product.</p>
    @endif
    <div class="d-flex justify-content-center">

    </div>
    {{ $products->links() }}
@endsection
