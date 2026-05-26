@extends('layouts.master')

@section('content')

<style>
    body{
        font-family:'Inter',system-ui;
        background:#f1f5f9;
    }

    .wrapper{
        max-width:850px;
        margin:40px auto;
        padding:0 16px;
    }

    .card{
        background:white;
        border-radius:16px;
        padding:24px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    }

    /* NAVY HEADER */
    .header-box{
        background:#0f172a;
        color:white;
        padding:16px 18px;
        border-radius:12px;
        margin-bottom:20px;
    }

    .header-box h2{
        margin:0;
        font-size:22px;
        font-weight:700;
    }

    label{
        font-size:13px;
        font-weight:600;
        margin-bottom:6px;
        display:block;
        color:#374151;
    }

    input, textarea, select{
        width:100%;
        padding:10px;
        border-radius:10px;
        border:1px solid #e5e7eb;
        font-size:14px;
    }

    input:focus, textarea:focus, select:focus{
        outline:none;
        border-color:#0f172a;
        box-shadow:0 0 0 3px rgba(15,23,42,0.1);
    }

    .group{
        margin-bottom:15px;
    }

    .my-btn{
    padding:10px 14px;
    border-radius:10px;
    font-weight:600;
    border:none;
    cursor:pointer;
    text-decoration:none;
    display:inline-block;
}

    .btn{
    background:#0f172a;
    color:white;
}

    .btn-secondary{
        background:#e5e7eb;
        color:#111827;
    }

</style>

<div class="wrapper">
<div class="card">

    {{-- HEADER BARU (NAVY + PUTIH) --}}
    <div class="header-box">
        <h2>Edit Data Penerima Bantuan</h2>
    </div>
@if ($errors->any())
    <div style="
        background:#fee2e2;
        border:1px solid #fecaca;
        color:#991b1b;
        padding:12px;
        border-radius:12px;
        margin-bottom:15px;
        font-size:13px;
    ">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin:6px 0 0 18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('penerima.update', $penerima->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="group">
        <label>NIK</label>
        <input type="text" name="nik" value="{{ old('nik',$penerima->nik) }}">
    </div>

    <div class="group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap',$penerima->nama_lengkap) }}">
    </div>

    <div class="group">
        <label>Alamat</label>
        <textarea name="alamat">{{ old('alamat',$penerima->alamat) }}</textarea>
    </div>

    <div class="group">
        <label>Jenis Bantuan</label>
        <select name="jenis_bantuan_id">
            @foreach($jenis as $j)
                <option value="{{ $j->id }}"
                    {{ old('jenis_bantuan_id',$penerima->jenis_bantuan_id)==$j->id?'selected':'' }}>
                    {{ $j->nama_bantuan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="group">
        <label>Kategori</label>
        <select name="nama_kategori">
            @foreach($kategori as $k)
                <option value="{{ $k->nama_kategori }}"
                    {{ old('nama_kategori',$penerima->nama_kategori)==$k->nama_kategori?'selected':'' }}>
                    {{ $k->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="group">
        <label>Status</label>
        <select name="status_penyaluran">
            <option value="Belum Disalurkan" {{ old('status_penyaluran',$penerima->status_penyaluran)=='Belum Disalurkan'?'selected':'' }}>
                Belum Disalurkan
            </option>
            <option value="Sudah Disalurkan" {{ old('status_penyaluran',$penerima->status_penyaluran)=='Sudah Disalurkan'?'selected':'' }}>
                Sudah Disalurkan
            </option>
        </select>
    </div>

    <div class="group">
        <label>Foto</label>
        @if($penerima->foto)
            <img src="{{ asset('foto/'.$penerima->foto) }}" width="80" style="border-radius:8px;">
        @endif

        <input type="file" name="foto">
    </div>

    <div style="display:flex;gap:10px;margin-top:20px;">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('penerima.index') }}" class="btn btn-secondary">Batal</a>
    </div>

    </form>

</div>
</div>

@endsection
