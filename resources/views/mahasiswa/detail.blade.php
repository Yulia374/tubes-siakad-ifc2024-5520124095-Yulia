@extends('layouts.admin')

@section('page-title', 'Detail Mahasiswa')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Detail Mahasiswa</h4>
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-3" style="max-width: 760px;">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
            <div class="avatar-circle" style="width: 56px; height: 56px; font-size: 1.4rem;">{{ strtoupper(substr($detailMahasiswa->nama, 0, 1)) }}</div>
            <div>
                <div class="fw-bold fs-5">{{ $detailMahasiswa->nama }}</div>
                <span class="pill pill-gold">{{ $detailMahasiswa->npm }}</span>
            </div>
        </div>

        <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">Kelas</dt>
            <dd class="col-sm-8"><span class="pill pill-olive">{{ $detailMahasiswa->kelas }}</span></dd>

            <dt class="col-sm-4 text-muted">Dosen Wali</dt>
            <dd class="col-sm-8">{{ $detailMahasiswa->dosen->nama ?? '-' }} ({{ $detailMahasiswa->nidn }})</dd>

            <dt class="col-sm-4 text-muted">Ditambahkan</dt>
            <dd class="col-sm-8">{{ $detailMahasiswa->created_at->translatedFormat('d F Y, H:i') }}</dd>
        </dl>
    </div>
</div>

<div class="card">
    <div class="card-header">Mata Kuliah yang Diambil (KRS)</div>
    <div class="card-body">
        @if($detailMahasiswa->krs->isEmpty())
            <div class="empty-state py-3">
                <i class="bi bi-inbox"></i>
                <p class="mb-0">Mahasiswa ini belum mengambil mata kuliah apapun.</p>
            </div>
        @else
            <table class="table table-sm table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailMahasiswa->krs as $krs)
                    <tr>
                        <td><span class="pill pill-gold">{{ $krs->kode_matakuliah }}</span></td>
                        <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                        <td>{{ $krs->matakuliah->sks ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
