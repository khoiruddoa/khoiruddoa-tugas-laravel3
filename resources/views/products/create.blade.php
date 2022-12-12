@extends('../layouts.main')
@section('container')
    <div class="d-flex justify-content-center mt-4">

        <div class="col-4">
            <div>
                <h1>Insert Product</h1>
            </div>
            <form method="post" action="/product" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Product</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">deskripsi</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">stock</label>
                    <input type="text" class="form-control" id="stock" name="stock">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
