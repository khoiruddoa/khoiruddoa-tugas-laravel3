@extends('../layouts.main')
@section('container')
    <div class="d-flex justify-content-center mt-4">

        <div class="col-4">
            <div>
                <h1>update Product</h1>
            </div>
            <form method="post" action="/product/{{ $product->id }}" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Product</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $product->name) }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="price" name="price"
                        value="{{ old('price', $product->price) }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">deskripsi</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ old('description', $product->description) }}">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">stock</label>
                    <input type="text" class="form-control" id="stock" name="stock"
                        value="{{ old('stock', $product->stock) }}">
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="{{ $product->photo }}" class="card-img-top" alt="...">
                    <div class="card-body">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    @(endsection)
