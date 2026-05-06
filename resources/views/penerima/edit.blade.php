@extends('layouts.master')

@section('content')

<h2 style="margin-bottom:20px;">
    Edit Data Penerima Bantuan
</h2>

{{-- ERROR VALIDATION --}}
@if ($errors->any())
<div style="background:#f8d7da;color:#721c24;padding:12px;border-radius:6px;margin-bottom:15px;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('penerima.update', $penerima->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div style="margin-bottom:15px;">
<label>NIK</label>
<input type="text"
       name="nik"
       value="{{ old('nik',$penerima->nik) }}"
       maxlength="16"
       required
       style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">
</div>

<div style="margin-bottom:15px;">
<label>Nama Lengkap</label>
<input type="text"
       name="nama_lengkap"
       value="{{ old('nama_lengkap',$penerima->nama_lengkap) }}"
       required
       style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">
</div>

<div style="margin-bottom:15px;">
<label>Alamat</label>
<textarea name="alamat"
          required
          style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">{{ old('alamat',$penerima->alamat) }}</textarea>
</div>

<div style="margin-bottom:15px;">
<label>Jenis Bantuan</label>
<select name="jenis_bantuan_id"
        required
        style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">

<option value="">-- Pilih Bantuan --</option>

@foreach($jenis as $j)
        <option value="{{ $j->id }}"
            {{ $penerima->jenis_bantuan_id == $j->id ? 'selected' : '' }}>
            {{ $j->nama_bantuan }}
        </option>
    @endforeach

</select>
</div>


<div style="margin-bottom:15px;">
    <label>Kategori</label>
    <select name="kategori_id"
        required
        style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">

        <option value="">-- Pilih Kategori --</option>

        @foreach($kategori as $k)
            <option value="{{ $k->id }}"
                {{ $penerima->kategori_id == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach

</select>
</div>

<div style="margin-bottom:20px;">
<label>Status Penyaluran</label>
<select name="status_penyaluran"
        required
        style="width:100%;padding:8px;border:1px solid #ccc;border-radius:5px;">

<option value="Belum Disalurkan"
{{ old('status_penyaluran',$penerima->status_penyaluran) == 'Belum Disalurkan' ? 'selected' : '' }}>
Belum Disalurkan
</option>

<option value="Sudah Disalurkan"
{{ old('status_penyaluran',$penerima->status_penyaluran) == 'Sudah Disalurkan' ? 'selected' : '' }}>
Sudah Disalurkan
</option>

</select>
</div>

{{-- BAGIAN FOTO --}}
<div style="margin-bottom:15px;">
    <label>Foto</label><br>

    {{-- FOTO LAMA --}}
    @if($penerima->foto)
        <img src="{{ asset('foto/'.$penerima->foto) }}" width="100" style="margin-bottom:10px;">
    @endif

    {{-- INPUT FOTO BARU --}}
    <input type="file" name="foto" onchange="previewFoto(event)">
    
    <br>
    <img id="preview" width="100" style="margin-top:10px;">
</div>

<div style="display:flex;gap:10px;">

<button type="submit" class="btn btn-primary">
Simpan Perubahan
</button>

<a href="{{ route('penerima.index') }}" class="btn btn-secondary">
Batal
</a>

</div>

</form>

{{--SCRIPT PREVIEW --}}
<script>
function previewFoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection