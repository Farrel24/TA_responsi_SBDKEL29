

@extends('layout.app') 

@section('content')
    <div class="container">
        <h2>Daftar Produk</h2>

        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tambahkan tombol untuk menuju halaman tambah produk -->
        <a href="{{ route('produk.add') }}" class="btn btn-primary mb-3">Tambah Produk</a>

        <!-- Tambahkan formulir pencarian -->
        <form action="{{ route('produk.search') }}" method="POST" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="Cari produk...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tabel untuk menampilkan data produk -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Harga Produk</th>
                    <th>Jumlah Produk</th>
                    <th>Stok</th>
                    <th>Tanggal Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $produk)
                    <tr>
                        <td>{{ $produk->id_produk }}</td>
                        <td>{{ $produk->harga_produk }}</td>
                        <td>{{ $produk->jumlah_produk }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>{{ $produk->tgl_pesanan }}</td>
                        <td>{{ $produk->nama_pelanggan }}</td>
                        <td>
                            <!-- Tambahkan tombol untuk mengedit dan menghapus -->
                            <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('produk.delete', $produk->id_produk) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                        <td>
                            @if($produk->delete_at)
                                <form action="/produk/restore/{{ $produk->id_produk }}" method="post" class="d-inline">
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
