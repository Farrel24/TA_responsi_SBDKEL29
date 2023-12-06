<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class PelangganController extends Controller
{
    use SoftDeletes;
    public function index()
    {
        $data = DB::table('pelanggan')
            ->join('pesanan', 'pelanggan.id_pesanan', '=', 'pesanan.id_pesanan')
            ->select('pelanggan.*', 'pesanan.tgl_pesanan')
            ->get();

        return view('pelanggan.index', compact('data'));
    }

    public function add()
    {
        return view('pelanggan.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'id_pesanan' => 'required',
        ]);

        DB::table('pelanggan')->insert([
            'email' => $request->email,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'id_pesanan' => $request->id_pesanan,
            
        ]);

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil disimpan');
    }

    public function edit($id)
    {
        $pelanggan = DB::table('pelanggan')->where('id_pelanggan', $id)->first();

        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'nama_pelanggan' => 'required',
            'alamat_pelanggan' => 'required',
            'id_pesanan' => 'required',
        ]);

        DB::table('pelanggan')->where('id_pelanggan', $id)->update([
            'email' => $request->email,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'id_pesanan' => $request->id_pesanan,
            
        ]);

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function delete($id)
    {
        // Soft Delete (gunakan jika ada kolom 'deleted_at' di tabel)
        DB::table('pelanggan')->where('id_pelanggan', $id)->update(['delete_at' => now()]);


        // Opsi 2: Hard Delete
        // DB::table('pelanggan')->where('id_pelanggan', $id)->delete();

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = DB::table('pelanggan')
            ->join('pesanan', 'pelanggan.id_pesanan', '=', 'pesanan.id_pesanan')
            ->select('pelanggan.*', 'pesanan.tgl_pesanan')
            ->where('nama_pelanggan', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->get();

        return view('pelanggan.index', compact('data'));
    }

    public function restore($id)
    {
        DB::table('pelanggan')->where('id_pelanggan', $id)->update(['delete_at' => null]);

        return redirect('/pelanggan')->with('success', 'Data pelanggan berhasil dipulihkan');
    }
}
