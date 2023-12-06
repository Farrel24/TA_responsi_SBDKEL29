@extends('layout.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <h1>Edit Pelanggan</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="/pelanggan/update/{{ $pelanggan->id_pelanggan }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $pelanggan->email }}" required>
        </div>
        <div class="form-group">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" required>
        </div>
        <div class="form-group">
            <label for="alamat_pelanggan">Alamat Pelanggan:</label>
            <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" rows="3" required>{{ $pelanggan->alamat_pelanggan }}</textarea>
        </div>
        <div class="form-group">
            <label for="id_pesanan">ID Pesanan:</label>
            <input type="number" class="form-control" id="id_pesanan" name="id_pesanan" value="{{ $pelanggan->id_pesanan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="/pelanggan" class="btn btn-secondary mt-3">Kembali</a>
@endsection
