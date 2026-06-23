<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekap KRS</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #2b2420;
        }

        .header {
            text-align: center;
            margin-bottom: 16px;
            border-bottom: 2px solid #7a1f2b;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 16px;
            color: #7a1f2b;
            margin: 0 0 2px;
        }

        .header p {
            margin: 0;
            font-size: 10px;
            color: #6b6258;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #d8d2c8;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f5f3ef;
            font-size: 10px;
            text-transform: uppercase;
        }

        .text-center { text-align: center; }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #9c948a;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SIAKAD &mdash; Rekap Kartu Rencana Studi (KRS)</h1>
        <p>Universitas Suryakancana &middot; Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="4%">No</th>
                <th width="13%">NPM</th>
                <th width="20%">Nama Mahasiswa</th>
                <th width="13%">Kode MK</th>
                <th width="28%">Mata Kuliah</th>
                <th class="text-center" width="8%">SKS</th>
                <th width="14%">Tanggal Diambil</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataKrs as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->npm }}</td>
                <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                <td>{{ $item->kode_matakuliah }}</td>
                <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td class="text-center">{{ $item->matakuliah->sks ?? '-' }}</td>
                <td>{{ $item->created_at->translatedFormat('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data KRS.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Total entri KRS: {{ $dataKrs->count() }}
    </div>
</body>
</html>
