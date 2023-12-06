

@extends('layout.app')

@section('content')
    <div class="container">
        <h2>Daftar Pesanan</h2>
        <a href="{{ url('/pesanan/add') }}" class="btn btn-success mb-2">Tambah Pesanan</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/pesanan/search') }}" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan tanggal atau nama pelanggan">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary">Cari</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal Pesanan</th>
                    <th>Total Harga</th>
                    <th>Jumlah Harga</th>
                    <th>Nama Pelanggan</th>
                    
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $pesanan)
                    <tr>
                        <td>{{ $pesanan->tgl_pesanan }}</td>
                        <td>{{ $pesanan->total_harga }}</td>
                        <td>{{ $pesanan->jumlah_harga }}</td>
                        <td>{{ $pesanan->nama_pelanggan }}</td>
                        <td>
                            <a href="{{ url('/pesanan/edit/' . $pesanan->id_pesanan) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ url('/pesanan/delete/' . $pesanan->id_pesanan) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</a>
                        </td>
                        <td>
                            @if($pesanan->delete_at)
                                <form action="/pesanan/restore/{{ $pesanan->id_pesanan }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin memulihkan data ini?')">Restore</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
