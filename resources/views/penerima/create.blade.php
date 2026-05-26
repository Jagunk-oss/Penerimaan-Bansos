@extends('layouts.master')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body{
        background:#f1f5f9;
        font-family:'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    .wrapper{
        max-width:920px;
        margin:40px auto;
        padding:0 16px;
    }

    .card{
        background:#fff;
        border-radius:18px;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
        overflow:hidden;
    }

    .header{
        padding:24px 28px;
        border-bottom:1px solid #1f2937;
        background:linear-gradient(135deg,#0f172a,#1e293b);
        color:white;
    }

    .header h2{
        margin:0;
        font-size:22px;
        font-weight:700;
    }

    .header p{
        margin:4px 0 0;
        font-size:13px;
        opacity:.9;
    }

    .content{
        padding:28px;
    }

    .alert-error{
        background:#fef2f2;
        border:1px solid #fecaca;
        color:#991b1b;
        padding:14px;
        border-radius:12px;
        margin-bottom:20px;
        font-size:14px;
    }

    .grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:18px;
    }

    .full{
        grid-column:span 2;
    }

    .form-group label{
        display:block;
        margin-bottom:6px;
        font-size:13px;
        font-weight:600;
        color:#374151;
    }

    .form-control{
        width:100%;
        padding:11px 12px;
        border:1px solid #e5e7eb;
        border-radius:12px;
        font-size:14px;
        background:#fff;
        font-family:'Inter', sans-serif;
    }

    .form-control:focus{
        border-color:#0f172a;
        box-shadow:0 0 0 4px rgba(15,23,42,0.15);
        outline:none;
    }

    textarea.form-control{
        min-height:90px;
        resize:vertical;
    }

    .button-group{
        margin-top:26px;
        display:flex;
        gap:12px;
        justify-content:flex-end;
    }

    .btn{
        padding:11px 16px;
        border-radius:12px;
        font-weight:600;
        font-size:14px;
        border:none;
        cursor:pointer;
        text-decoration:none;
    }

    .btn-save{
        background:#0f172a;
        color:white;
    }

    .btn-save:hover{
        background:#1e293b;
    }

    .btn-cancel{
        background:#e5e7eb;
        color:#111827;
    }
</style>

<div class="wrapper">
    <div class="card">

        <div class="header">
            <h2>Tambah Data Penerima Bantuan</h2>
            <p>Isi data dengan benar agar proses verifikasi berjalan lancar</p>
        </div>

        <div class="content">

            @if ($errors->any())
                <div class="alert-error">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('penerima.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid">

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik"
                               value="{{ old('nik') }}"
                               maxlength="16"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap"
                               value="{{ old('nama_lengkap') }}"
                               class="form-control" required>
                    </div>

                    <div class="form-group full">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Jenis Bantuan</label>
                        <select name="jenis_bantuan_id" class="form-control" required>
                            <option value="">-- Pilih Bantuan --</option>
                            @foreach($jenis as $j)
                                <option value="{{ $j->id }}"
                                    {{ old('jenis_bantuan_id') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_bantuan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="nama_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->nama_kategori }}"
                                    {{ old('nama_kategori') == $k->nama_kategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Penyaluran</label>
                        <select name="status_penyaluran" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Disalurkan" {{ old('status_penyaluran') == 'Belum Disalurkan' ? 'selected' : '' }}>
                                Belum Disalurkan
                            </option>
                            <option value="Sudah Disalurkan" {{ old('status_penyaluran') == 'Sudah Disalurkan' ? 'selected' : '' }}>
                                Sudah Disalurkan
                            </option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                </div>

                <div class="button-group">
                    <a href="{{ route('penerima.index') }}" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-save">Simpan Data</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
