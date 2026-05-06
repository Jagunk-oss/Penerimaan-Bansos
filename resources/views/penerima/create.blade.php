@extends('layouts.master')

@section('content')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Tambah Data Penerima Bantuan
</h2>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penerima.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- NIK --}}
                <div class="mb-4">
                    <label>NIK</label>
                    <input type="text" name="nik"
                        value="{{ old('nik') }}"
                        pattern="[0-9]{16}"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                        required>
                </div>

                {{-- Nama --}}
                <div class="mb-4">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap"
                        value="{{ old('nama_lengkap') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                        required>
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label>Alamat</label>
                    <textarea name="alamat"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                        required>{{ old('alamat') }}</textarea>
                </div>

                {{-- Jenis Bantuan --}}
                <div class="mb-4">
                    <label>Jenis Bantuan</label>
                    <select name="jenis_bantuan_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                        required>
                        <option value="">-- Pilih --</option>
                        
                        @foreach($jenis as $j)
                            <option value="{{ $j->id }}">
                                {{ $j->nama_bantuan }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- STATUS (WAJIB ADA) --}}
                <div class="mb-6">
                    <label>Status Penyaluran</label>
                    <select name="status_penyaluran"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                        required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Disalurkan">Belum Disalurkan</option>
                        <option value="Sudah Disalurkan">Sudah Disalurkan</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label>Kategori</label>
                    <select name="kategori_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                        required>

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- FOTO --}}
                <div class="mb-6">
                    <label>Foto</label>
                    <input type="file" name="foto"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- Tombol --}}
                <div class="flex items-center gap-4">
                    <button type="submit"
                        style="background:green;color:white;padding:10px 15px;border-radius:6px;">
                        Simpan Data
                    </button>

                    <a href="{{ route('penerima.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection