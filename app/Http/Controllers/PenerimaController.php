<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;
use App\Models\JenisBantuan;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;

class PenerimaController extends Controller
{
    /**
     * Menampilkan semua data penerima
     */
    public function index()
    {
        $penerimas = Penerima::with('jenisBantuan')->get();

        return view('penerima.index', compact('penerimas'));
    }

    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        $jenis = JenisBantuan::all();

        $kategori = Kategori::all();

        return view('penerima.create', compact('jenis', 'kategori'));
    }

    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([

            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'jenis_bantuan_id' => 'required',
            'nama_kategori' => 'required',
            'status_penyaluran' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $data = $request->all();

        // AMBIL NAMA BANTUAN DARI RELASI
        $jenis = JenisBantuan::find($request->jenis_bantuan_id);

        if ($jenis) {
            $data['jenis_bantuan'] = $jenis->nama_bantuan;
        }

        // UPLOAD FOTO
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('foto'), $namaFile);

            $data['foto'] = $namaFile;
        }

        // SIMPAN DATA
        Penerima::create($data);

        return redirect()
                ->route('penerima.index')
                ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Menampilkan detail data
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Menampilkan form edit
     */
    public function edit(string $id)
    {
        $penerima = Penerima::findOrFail($id);

        $jenis = JenisBantuan::all();

        $kategori = Kategori::all();

        return view('penerima.edit', compact('penerima', 'jenis', 'kategori'));
    }

    /**
     * Update data
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'nik' => 'required|digits:16',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'jenis_bantuan_id' => 'required',
            'nama_kategori' => 'required',
            'status_penyaluran' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $penerima = Penerima::findOrFail($id);

        $data = $request->all();

        // AMBIL NAMA BANTUAN
        $jenis = JenisBantuan::find($request->jenis_bantuan_id);

        if ($jenis) {
            $data['jenis_bantuan'] = $jenis->nama_bantuan;
        }

        // FOTO BARU
        if ($request->hasFile('foto')) {

            // HAPUS FOTO LAMA
            if (
                $penerima->foto &&
                file_exists(public_path('foto/'.$penerima->foto))
            ) {
                unlink(public_path('foto/'.$penerima->foto));
            }

            // SIMPAN FOTO BARU
            $file = $request->file('foto');

            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('foto'), $namaFile);

            $data['foto'] = $namaFile;
        }

        // UPDATE DATA
        $penerima->update($data);

        return redirect()
                ->route('penerima.index')
                ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Hapus data
     */
    public function destroy(string $id)
    {
        $penerima = Penerima::findOrFail($id);

        // HAPUS FOTO
        if (
            $penerima->foto &&
            file_exists(public_path('foto/'.$penerima->foto))
        ) {
            unlink(public_path('foto/'.$penerima->foto));
        }

        // HAPUS DATA
        $penerima->delete();

        return redirect()
                ->route('penerima.index')
                ->with('success', 'Data berhasil dihapus');
    }

    public function exportPdf()
    {
        $penerimas = Penerima::all();

        $pdf = Pdf::loadView('penerima.pdf', compact('penerimas'));

        return $pdf->download('laporan-penerima-bansos.pdf');
    }
}
