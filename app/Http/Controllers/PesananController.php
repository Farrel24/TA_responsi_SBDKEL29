<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class PesananController extends Controller
{
    use SoftDeletes;
    public function index()
    {
        $data = DB::table('pesanan')
        ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
        ->select('pesanan.*', 'pelanggan.nama_pelanggan')
        ->get();

        return view('pesanan.index', compact('data'));
    }

    public function add()
    {
        return view('pesanan.add');
    }
    public function generateUniqueID()
    {
        return time();
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_pesanan' => 'required',
            'total_harga' => 'required',
            'jumlah_harga' => 'required',
            'id_pelanggan' => 'required',
        ]);

        $id_pesanan = $this->generateUniqueID();

        DB::table('pesanan')->insert([
            'id_pesanan' => $id_pesanan,
            'tgl_pesanan' => $request->tgl_pesanan,
            'total_harga' => $request->total_harga,
            'jumlah_harga' => $request->jumlah_harga,
            'id_pelanggan' => $request->id_pelanggan,
        ]);

        return redirect('/pesanan')->with('success', 'Data pesanan berhasil disimpan');
    }


    public function edit($id)
    {
        $pesanan = DB::table('pesanan')->where('id_pesanan', $id)->first();

        return view('pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_pesanan' => 'required',
            'total_harga' => 'required',
            'jumlah_harga' => 'required',
            'id_pelanggan' => 'required',
        ]);

        DB::table('pesanan')->where('id_pesanan', $id)->update([
            'tgl_pesanan' => $request->tgl_pesanan,
            'total_harga' => $request->total_harga,
            'jumlah_harga' => $request->jumlah_harga,
            'id_pelanggan' => $request->id_pelanggan,
            
        ]);

        return redirect('/pesanan')->with('success', 'Data pesanan berhasil diperbarui');
    }

    public function delete($id)
    {
        // Soft Delete (gunakan jika ada kolom 'deleted_at' di tabel)
        DB::table('pesanan')->where('id_pesanan', $id)->update(['delete_at' => now()]);

        // Opsi 2: Hard Delete
        // DB::table('pelanggan')->where('id_pelanggan', $id)->delete();

        return redirect('/pesanan')->with('success', 'Data pesanan berhasil dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('produk', 'pesanan.id_pesanan', '=', 'produk.id_pesanan')
            ->select('pesanan.*', 'pelanggan.nama_pelanggan', 'produk.harga_produk')
            ->where('tgl_pesanan', 'like', '%' . $keyword . '%')
            ->orWhere('total_harga', 'like', '%' . $keyword . '%')
            ->orWhere('jumlah_harga', 'like', '%' . $keyword . '%')
            ->orWhere('nama_pelanggan', 'like', '%' . $keyword . '%')
            ->orWhere('harga_produk', 'like', '%' . $keyword . '%')
            ->get();

        return view('pesanan.index', compact('data'));
    }
    public function restore($id)
    {
        DB::table('pesanan')->where('id_pesanan', $id)->update(['delete_at' => null]);

        return redirect('/pesanan')->with('success', 'Data pesanan berhasil dipulihkan');
    }
}
