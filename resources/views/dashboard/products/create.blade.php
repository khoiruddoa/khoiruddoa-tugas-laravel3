@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-center mt-4">

        <div class="col-4">
            <div class="mb-3">
                <h1>Insert Product</h1>
            </div>
            <form method="post" action="/dashboard/products" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Product</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" required
                        value="{{ old('price') }}">
                </div>
                <label for="description">Deskripsi</label>
                <div class="form-floating">

                    <textarea class="form-control" placeholder="Leave a description here" id="description" name="description"
                        value="{{ old('description') }}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">your picture</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
