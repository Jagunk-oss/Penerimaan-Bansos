@extends('layouts.master')

@section('content')

<style>
    body{
        font-family:'Inter',system-ui;
        background:#f1f5f9;
    }

    .wrapper{
        max-width:1100px;
        margin:40px auto;
        padding:0 16px;
    }

    .title-box{
        background:linear-gradient(135deg,#0f172a,#1e293b);
        padding:20px 24px;
        border-radius:14px;
        margin-bottom:20px;
        box-shadow:0 10px 25px rgba(15,23,42,0.2);
    }

    .title-box h2{
        margin:0;
        font-size:22px;
        font-weight:700;
        color:white;
    }

    .title-box p{
        margin:5px 0 0;
        font-size:13px;
        color:rgba(255,255,255,0.8);
    }

    table{
        width:100%;
        border-collapse:collapse;
        background:white;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 10px 25px rgba(0,0,0,0.05);
    }

    th{
        background:#0f172a;
        color:white;
        padding:12px;
        font-size:13px;
        text-align:left;
    }

    td{
        padding:12px;
        border-bottom:1px solid #e5e7eb;
        font-size:14px;
        vertical-align:middle;
    }

    tr:hover{
        background:#f8fafc;
    }

    .badge{
        padding:5px 10px;
        border-radius:999px;
        font-size:12px;
        font-weight:600;
        display:inline-block;
    }

    .belum{ background:#fee2e2; color:#991b1b; }
    .sudah{ background:#dcfce7; color:#166534; }

    .actions{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .btn{
        padding:8px 12px;
        border-radius:10px;
        font-weight:600;
        text-decoration:none;
        font-size:13px;
        border:none;
        cursor:pointer;
        display:inline-block;
    }

    .btn-primary{ background:#0f172a; color:white; }
    .btn-primary:hover{ background:#1e293b; }

    .btn-danger{ background:#ef4444; color:white; }
    .btn-danger:hover{ background:#dc2626; }

    .btn-warning{ background:#f59e0b; color:white; }
    .btn-warning:hover{ background:#d97706; }

    .bottom-bar{
        display:flex;
        justify-content:flex-end;
        gap:10px;
        margin-top:20px;
        flex-wrap:wrap;
    }

    .alert-success{
        background:#dcfce7;
        color:#166534;
        padding:12px;
        border-radius:10px;
        margin-bottom:15px;
        font-weight:600;
    }

    .empty{
        text-align:center;
        padding:20px;
        color:#6b7280;
    }

    img{
        border-radius:8px;
        object-fit:cover;
    }
</style>

<div class="wrapper">

    <div class="title-box">
        <h2>Data Penerima Bantuan Sosial</h2>
        <p>Kelola data penerima bantuan dengan mudah dan cepat</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($penerimas as $item)
            <tr>
                <td>{{ $item->nik ?? '-' }}</td>
                <td>{{ $item->nama_lengkap ?? '-' }}</td>
                <td>{{ $item->alamat ?? '-' }}</td>

                <td>{{ $item->jenisBantuan->nama_bantuan ?? '-' }}</td>

                <td>
                    @if($item->status_penyaluran == 'Sudah Disalurkan')
                        <span class="badge sudah">Sudah</span>
                    @else
                        <span class="badge belum">Belum</span>
                    @endif
                </td>

                <td>{{ $item->nama_kategori ?? '-' }}</td>

                <td>
                    @if($item->foto)
                        <img src="{{ asset('foto/'.$item->foto) }}" width="50" height="50">
                    @else
                        -
                    @endif
                </td>

                <td>
                    <div class="actions">
                        <a href="{{ route('penerima.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('penerima.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="empty">
                    Belum ada data penerima bantuan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="bottom-bar">
        <a href="{{ route('penerima.pdf') }}" class="btn btn-danger">Cetak PDF</a>
        <a href="{{ route('penerima.create') }}" class="btn btn-primary">+ Tambah Data</a>
    </div>

</div>

@endsection
