

@extends('layout.app')

@section('content')
    <div class="container">
        <h2>Edit Pesanan</h2>
        <form method="POST" action="{{ url('/pesanan/update/' . $pesanan->id_pesanan) }}">
            @csrf
            <div class="form-group">
                <label for="tgl_pesanan">Tanggal Pesanan:</label>
                <input type="date" class="form-control" id="tgl_pesanan" name="tgl_pesanan" value="{{ $pesanan->tgl_pesanan }}" required>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="text" class="form-control" id="total_harga" name="total_harga" value="{{ $pesanan->total_harga }}" required>
            </div>
            <div class="form-group">
                <label for="jumlah_harga">Jumlah Harga:</label>
                <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="{{ $pesanan->jumlah_harga }}" required>
            </div>
            <div class="form-group">
                <label for="id_pelanggan">ID Pelanggan:</label>
                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="{{ $pesanan->id_pelanggan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Pesanan</button>
        </form>
    </div>
@endsection
