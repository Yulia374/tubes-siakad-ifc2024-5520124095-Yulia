<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>KRS - {{ $mahasiswa->npm }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #2b2420;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
            border-bottom: 2px solid #7a1f2b;
            padding-bottom: 12px;
        }

        .header h1 {
            font-size: 17px;
            color: #7a1f2b;
            margin: 0 0 3px;
        }

        .header p {
            margin: 0;
            font-size: 11px;
            color: #6b6258;
        }

        .info-table {
            width: 100%;
            margin-bottom: 16px;
        }

        .info-table td {
            padding: 3px 0;
            font-size: 12px;
        }

        .info-table td.label {
            width: 140px;
            color: #6b6258;
        }

        table.krs-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table.krs-table th, table.krs-table td {
            border: 1px solid #d8d2c8;
            padding: 7px 9px;
            text-align: left;
        }

        table.krs-table th {
            background-color: #f5f3ef;
            font-size: 10px;
            text-transform: uppercase;
        }

        .text-center { text-align: center; }

        .total-row td {
            font-weight: bold;
            background-color: #f5f3ef;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #9c948a;
            text-align: right;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
        }

        .signature td {
            text-align: center;
            font-size: 11px;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <p>Universitas Suryakancana &middot; Sistem Informasi Akademik</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">NPM</td>
            <td>: {{ $mahasiswa->npm }}</td>
            <td class="label">Dicetak pada</td>
            <td>: {{ now()->translatedFormat('d F Y, H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="label">Nama Mahasiswa</td>
            <td>: {{ $mahasiswa->nama }}</td>
            <td class="label">Dosen Wali</td>
            <td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
        </tr>
    </table>

    <table class="krs-table">
        <thead>
            <tr>
                <th class="text-center" width="8%">No</th>
                <th width="20%">Kode Mata Kuliah</th>
                <th width="52%">Nama Mata Kuliah</th>
                <th class="text-center" width="20%">SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krsList as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->kode_matakuliah }}</td>
                <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td class="text-center">{{ $item->matakuliah->sks ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada mata kuliah yang diambil.</td>
            </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" class="text-center">Total SKS</td>
                <td class="text-center">{{ $totalSks }}</td>
            </tr>
        </tbody>
    </table>

    <table class="signature">
        <tr>
            <td width="50%">
                Mengetahui,<br>Dosen Wali
                <br><br><br><br>
                ( {{ $mahasiswa->dosen->nama ?? '............................' }} )
            </td>
            <td width="50%">
                Mahasiswa Bersangkutan
                <br><br><br><br>
                ( {{ $mahasiswa->nama }} )
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen ini dicetak otomatis melalui sistem SIAKAD.
    </div>
</body>
</html>
