

@extends('layout.app') 

@section('content')
    <div class="container">
        <h2>Add New Product</h2>
        <form action="{{ route('produk.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="harga_produk">Product Price</label>
                <input type="text" class="form-control" id="harga_produk" name="harga_produk" required>
            </div>
            <div class="form-group">
                <label for="jumlah_produk">Quantity</label>
                <input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" required>
            </div>
            <div class="form-group">
                <label for="stok">Stock</label>
                <input type="text" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="id_pesanan">Order ID</label>
                <input type="text" class="form-control" id="id_pesanan" name="id_pesanan" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
