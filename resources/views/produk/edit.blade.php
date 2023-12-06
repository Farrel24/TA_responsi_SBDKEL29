<!-- resources/views/produk/edit.blade.php -->

@extends('layout.app') <!-- Sesuaikan dengan layout yang Anda gunakan -->

@section('content')
    <div class="container">
        <h2>Edit Produk</h2>

        <!-- Tampilkan pesan error jika validasi gagal -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulir untuk mengedit produk -->
        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="harga_produk">Harga Produk</label>
                <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="{{ $produk->harga_produk }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_produk">Jumlah Produk</label>
                <input type="text" class="form-control" id="jumlah_produk" name="jumlah_produk" value="{{ $produk->jumlah_produk }}" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}" required>
            </div>
            <div class="form-group">
                <label for="id_pesanan">ID Pesanan</label>
                <input type="text" class="form-control" id="id_pesanan" name="id_pesanan" value="{{ $produk->id_pesanan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
