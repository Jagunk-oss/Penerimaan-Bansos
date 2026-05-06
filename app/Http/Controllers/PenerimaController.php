<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\JenisBantuan;
use App\Models\Kategori;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerimas = Penerima::with('jenisBantuan','kategori')->get();
        return view('penerima.index', compact('penerimas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = JenisBantuan::all();
        $kategori = Kategori::all();

    return view('penerima.create', compact('jenis','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'nik' => 'required|digits:16',
        'nama_lengkap' => 'required',
        'alamat' => 'required',
        'jenis_bantuan_id' => 'required',
        'status_penyaluran' => 'required',
        'kategori_id' => 'required',
        'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $namaFile = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('foto'), $namaFile);

        $data['foto'] = $namaFile;
    }

    Penerima::create($data);

    return redirect()->route('penerima.index')
        ->with('success', 'Data berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penerima = Penerima::findOrFail($id);
        $jenis = JenisBantuan::all();
        $kategori = Kategori::all(); // TAMBAHKAN

        return view('penerima.edit', compact('penerima', 'jenis','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'nik' => 'required|digits:16',
        'nama_lengkap' => 'required',
        'alamat' => 'required',
        'jenis_bantuan_id' => 'required',
        'status_penyaluran' => 'required',
        'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $penerima = Penerima::find($id);
    $data = $request->all();

    // CEK kalau upload foto baru
    if ($request->hasFile('foto')) {

        // HAPUS FOTO LAMA
        if ($penerima->foto && file_exists(public_path('foto/'.$penerima->foto))) {
            unlink(public_path('foto/'.$penerima->foto));
        }

        // SIMPAN FOTO BARU
        $file = $request->file('foto');
        $namaFile = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('foto'), $namaFile);

        $data['foto'] = $namaFile;
    }

    $penerima->update($data);

    return redirect()->route('penerima.index')
        ->with('success', 'Data berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penerima = Penerima::findOrFail($id);

    // HAPUS FILE FOTO
    if ($penerima->foto && file_exists(public_path('foto/'.$penerima->foto))) {
        unlink(public_path('foto/'.$penerima->foto));
    }

    // HAPUS DATA
    $penerima->delete();

    return redirect()->route('penerima.index')
        ->with('success', 'Data berhasil dihapus');
    }
}
