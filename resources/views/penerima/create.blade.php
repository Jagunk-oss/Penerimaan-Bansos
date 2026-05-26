@extends('layouts.master')

@section('content')

<style>
    body{
        background-color: #f3f4f6;
        font-family: Arial, sans-serif;
    }

    .card-form{
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .title{
        font-size: 28px;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .subtitle{
        color: #6b7280;
        margin-bottom: 30px;
    }

    .alert-error{
        background: #fee2e2;
        color: #991b1b;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .grid{
        display: grid;
        grid-template-columns: repeat(2,1fr);
        gap: 20px;
    }

    .full{
        grid-column: span 2;
    }

    .form-group{
        display: flex;
        flex-direction: column;
    }

    .form-group label{
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
    }

    .form-control{
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.3s;
    }

    .form-control:focus{
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
    }

    textarea.form-control{
        min-height: 100px;
        resize: vertical;
    }

    .button-group{
        margin-top: 30px;
        display: flex;
        gap: 12px;
    }

    .btn{
        padding: 12px 18px;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-save{
        background: #16a34a;
    }

    .btn-save:hover{
        background: #15803d;
    }

    .btn-cancel{
        background: #6b7280;
    }

    .btn-cancel:hover{
        background: #4b5563;
    }

    .preview{
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ccc;
        margin-top: 10px;
        display: none;
    }

    @media(max-width:768px){

        .grid{
            grid-template-columns: 1fr;
        }

        .full{
            grid-column: span 1;
        }

        .button-group{
            flex-direction: column;
        }
    }
</style>

<div class="card-form">

    <div class="title">
        Tambah Data Penerima Bantuan
    </div>

    <div class="subtitle">
        Silakan isi data penerima bantuan dengan lengkap dan benar.
    </div>

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())

        <div class="alert-error">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('penerima.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="grid">

            {{-- NIK --}}
            <div class="form-group">

                <label>NIK</label>

                <input type="text"
                       name="nik"
                       value="{{ old('nik') }}"
                       pattern="[0-9]{16}"
                       maxlength="16"
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
                       value="{{ old('nama_lengkap') }}"
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
                          required>{{ old('alamat') }}</textarea>

            </div>

            {{-- JENIS BANTUAN --}}
            <div class="form-group">

                <label>Jenis Bantuan</label>

                <select name="jenis_bantuan_id"
                        class="form-control"
                        required>

                    <option value="">-- Pilih Bantuan --</option>

                    @foreach($jenis as $j)

                        <option value="{{ $j->id }}">

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

                        <option value="{{ $k->nama_kategori }}">

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

                    <option value="">-- Pilih Status --</option>

                    <option value="Belum Disalurkan">

                        Belum Disalurkan

                    </option>

                    <option value="Sudah Disalurkan">

                        Sudah Disalurkan

                    </option>

                </select>

            </div>

            {{-- FOTO --}}
            <div class="form-group">

                <label>Foto</label>

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

                Simpan Data

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
