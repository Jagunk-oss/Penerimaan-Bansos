@extends('layouts.master')

@section('content')

<h2 style="margin-bottom:20px;">
    Data Penerima Bantuan Sosial
</h2>

{{-- Notifikasi sukses --}}
@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

{{-- Tombol Tambah --}}
<a href="{{ route('penerima.create') }}" class="btn btn-primary">
    + Tambah Data
</a>

<br><br>

<table>
    <thead>
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Bantuan</th>
            <th>Status</th>
            <th>Kategori</th>
            <th>Foto</th>
            <th style="text-align:center;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($penerimas as $item)
        <tr>
            <td>{{ $item->nik }}</td>
            <td>{{ $item->nama_lengkap }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->jenisBantuan->nama_bantuan ?? '-' }}</td>

            <!-- STATUS PENYALURAN -->
            <td>{{ $item->status_penyaluran }}</td>
            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>

            {{-- FOTO --}}
            <td>
                @if($item->foto)
                    <img src="{{ asset('foto/'.$item->foto) }}" width="80">
                @else
                    Tidak ada foto
                @endif
            </td>

            <!-- AKSI -->
            <td style="text-align:center;">
                <a href="{{ route('penerima.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('penerima.destroy', $item->id) }}"
                    method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('Yakin mau hapus data ini?')">

                    @csrf
                    @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Hapus
            </button>
        </form>
    </td>
</tr>

        @empty
        <tr>
            <td colspan="7" style="text-align:center;padding:20px;">
                Belum ada data penerima bantuan.
            </td>
        </tr>
        @endforelse
    </tbody>

</table>

<<<<<<< HEAD
@endsection
=======
<a href="{{ route('penerima.pdf') }}" class="btn btn-danger mb-3">
    Cetak PDF
</a>

@endsection
>>>>>>> 847e02d1374acd8ad79f80d86cc9fba6e5fb3963
