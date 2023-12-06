<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $data = DB::table('produk')
        ->join('pesanan', 'produk.id_pesanan', '=', 'pesanan.id_pesanan')
        ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
        ->select('produk.*', 'pesanan.tgl_pesanan', 'pelanggan.nama_pelanggan')
        ->get();

        return view('produk.index', compact('data'));
    }

    public function add()
    {
        return view('produk.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga_produk' => 'required',
            'jumlah_produk' => 'required',
            'stok' => 'required',
            'id_pesanan' => 'required',
        ]);

        DB::table('produk')->insert([
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'stok' => $request->stok,
            'id_pesanan' => $request->id_pesanan,
        ]);

        return redirect('/produk')->with('success', 'Data produk berhasil disimpan');
    }

    public function edit($id)
    {
        $produk = DB::table('produk')->where('id_produk', $id)->first();

        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'harga_produk' => 'required',
            'jumlah_produk' => 'required',
            'stok' => 'required',
            'id_pesanan' => 'required',
        ]);

        DB::table('produk')->where('id_produk', $id)->update([
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'stok' => $request->stok,
            'id_pesanan' => $request->id_pesanan,
            
        ]);

        return redirect('/produk')->with('success', 'Data produk berhasil diperbarui');
    }

    public function delete($id)
    {
        // Soft Delete (gunakan jika ada kolom 'deleted_at' di tabel)
        DB::table('produk')->where('id_produk', $id)->update(['delete_at' => now()]);

        // Opsi 2: Hard Delete
        // DB::table('pelanggan')->where('id_pelanggan', $id)->delete();

        return redirect('/produk')->with('success', 'Data produk berhasil dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = DB::table('produk')
        ->join('pesanan', 'produk.id_pesanan', '=', 'pesanan.id_pesanan')
        ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
        ->select('produk.*', 'pesanan.tgl_pesanan', 'pelanggan.nama_pelanggan')
        ->where('harga_produk', 'like', '%' . $keyword . '%')
        ->orWhere('jumlah_produk', 'like', '%' . $keyword . '%')
        ->orWhere('stok', 'like', '%' . $keyword . '%')
        ->orWhere('tgl_pesanan', 'like', '%' . $keyword . '%')
        ->orWhere('nama_pelanggan', 'like', '%' . $keyword . '%')
        ->get();
    }
    public function restore($id)
    {
        DB::table('produk')->where('id_produk', $id)->update(['delete_at' => null]);

        return redirect('/produk')->with('success', 'Data produk berhasil dipulihkan');
    }
}
