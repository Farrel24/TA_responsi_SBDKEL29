@extends('layout.app')

@section('title', 'Daftar Pelanggan')

@section('content')
    <h1>Daftar Pelanggan</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="/pelanggan/add" class="btn btn-primary">Tambah Pelanggan</a>
    </div>

    <form action="/pelanggan/search" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari pelanggan..." name="keyword">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>ID Pesanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $item->id_pelanggan }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->alamat_pelanggan }}</td>
                    <td>{{ $item->id_pesanan }}</td>
                    <td>
                        <a href="/pelanggan/edit/{{ $item->id_pelanggan }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/pelanggan/delete/{{ $item->id_pelanggan }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        @if($item->delete_at)
                            <form action="/pelanggan/restore/{{ $item->id_pelanggan }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin memulihkan data ini?')">Restore</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
