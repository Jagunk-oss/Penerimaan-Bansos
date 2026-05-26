<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penerima Bansos</title>

    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Laporan Data Penerima Bansos</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Bantuan</th>
                <th>Status Penyaluran</th>
            </tr>
        </thead>

        <tbody>
            @foreach($penerimas as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->jenis_bantuan }}</td>
                <td>{{ $item->status_penyaluran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>