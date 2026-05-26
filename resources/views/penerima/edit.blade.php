@extends('layouts.master')

@section('content')

<style>
    body{
        background:#f3f4f6;
        font-family:Arial,sans-serif;
    }

    .card-form{
        max-width:900px;
        margin:40px auto;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 4px 12px rgba(0,0,0,0.08);
    }

    .title{
        font-size:28px;
        font-weight:bold;
        color:#1f2937;
        margin-bottom:5px;
    }

    .subtitle{
        color:#6b7280;
        margin-bottom:30px;
    }

    .alert-error{
        background:#fee2e2;
        color:#991b1b;
        padding:15px;
        border-radius:10px;
        margin-bottom:20px;
    }

    .grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:20px;
    }

    .full{
        grid-column:span 2;
    }

    .form-group{
        display:flex;
        flex-direction:column;
    }

    .form-group label{
        margin-bottom:8px;
        font-weight:600;
        color:#374151;
    }

    .form-control{
        padding:12px;
        border:1px solid #d1d5db;
        border-radius:10px;
        font-size:14px;
    }

    .form-control:focus{
        outline:none;
        border-color:#2563eb;
        box-shadow:0 0 0 3px rgba(37,99,235,0.2);
    }

    textarea.form-control{
        min-height:100px;
        resize:vertical;
    }

    .foto-lama{
        width:120px;
        height:120px;
        object-fit:cover;
        border-radius:10px;
        border:1px solid #ccc;
        margin-bottom:10px;
    }

    .preview{
        width:120px;
        height:120px;
        object-fit:cover;
        border-radius:10px;
        border:1px solid #ccc;
        margin-top:10px;
        display:none;
    }

    .button-group{
        margin-top:30px;
        display:flex;
        gap:12px;
    }

    .btn{
        padding:12px 18px;
        border:none;
        border-radius:10px;
        text-decoration:none;
        color:white;
        font-weight:600;
        cursor:pointer;
    }

    .btn-save{
        background:#2563eb;
    }

    .btn-save:hover{
        background:#1d4ed8;
    }

    .btn-cancel{
        background:#6b7280;
    }

    .btn-cancel:hover{
        background:#4b5563;
    }

    @media(max-width:768px){

        .grid{
            grid-template-columns:1fr;
        }

        .full{
            grid-column:span 1;
        }

        .button-group{
            flex-direction:column;
        }
    }
</style>

<div class="card-form">

    <div class="title">
        Edit Data Penerima Bantuan
    </div>

    <div class="subtitle">
        Perbarui data penerima bantuan sosial.
    </div>

    {{-- ERROR --}}
    @if ($errors->any())

        <div class="alert-error">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('penerima.update', $penerima->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid">

            {{-- NIK --}}
            <div class="form-group">

                <label>NIK</label>

                <input type="text"
                       name="nik"
                       value="{{ old('nik',$penerima->nik) }}"
                       maxlength="16"
                       pattern="[0-9]{16}"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                       class="form-control"
                       placeholder="Masukkan 16 digit NIK"
                       required>

            </div>

            {{-- NAMA --}}
            <div class="form-group">

                <label>Nama Lengkap</label>

                <input type="text"
                       name="nama_lengkap"
                       value="{{ old('nama_lengkap',$penerima->nama_lengkap) }}"
                       class="form-control"
                       placeholder="Masukkan nama lengkap"
                       required>

            </div>

            {{-- ALAMAT --}}
            <div class="form-group full">

                <label>Alamat</label>

                <textarea name="alamat"
                          class="form-control"
                          placeholder="Masukkan alamat lengkap"
                          required>{{ old('alamat',$penerima->alamat) }}</textarea>

            </div>

            {{-- JENIS BANTUAN --}}
            <div class="form-group">

                <label>Jenis Bantuan</label>

                <select name="jenis_bantuan_id"
                        class="form-control"
                        required>

                    <option value="">-- Pilih Bantuan --</option>

                    @foreach($jenis as $j)

                        <option value="{{ $j->id }}"
                            {{ old('jenis_bantuan_id',$penerima->jenis_bantuan_id) == $j->id ? 'selected' : '' }}>

                            {{ $j->nama_bantuan }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- KATEGORI --}}
            <div class="form-group">

                <label>Kategori</label>

                <select name="nama_kategori"
                        class="form-control"
                        required>

                    <option value="">-- Pilih Kategori --</option>

                    @foreach($kategori as $k)

                        <option value="{{ $k->nama_kategori }}"
                            {{ old('nama_kategori',$penerima->nama_kategori) == $k->nama_kategori ? 'selected' : '' }}>

                            {{ $k->nama_kategori }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- STATUS --}}
            <div class="form-group">

                <label>Status Penyaluran</label>

                <select name="status_penyaluran"
                        class="form-control"
                        required>

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

            {{-- FOTO --}}
            <div class="form-group">

                <label>Foto</label>

                @if($penerima->foto)

                    <img src="{{ asset('foto/'.$penerima->foto) }}"
                         class="foto-lama">

                @endif

                <input type="file"
                       name="foto"
                       class="form-control"
                       accept="image/*"
                       onchange="previewFoto(event)">

                <img id="preview" class="preview">

            </div>

        </div>

        {{-- BUTTON --}}
        <div class="button-group">

            <button type="submit"
                    class="btn btn-save">

                Simpan Perubahan

            </button>

            <a href="{{ route('penerima.index') }}"
               class="btn btn-cancel">

                Batal

            </a>

        </div>

    </form>

</div>

<script>

function previewFoto(event){

    const preview = document.getElementById('preview');

    preview.src = URL.createObjectURL(event.target.files[0]);

    preview.style.display = 'block';
}

</script>

@endsection
