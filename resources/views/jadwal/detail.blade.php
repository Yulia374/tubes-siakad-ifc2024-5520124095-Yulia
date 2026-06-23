@extends('layouts.admin')

@section('page-title', 'Detail Jadwal')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Detail Jadwal Kuliah</h4>
    </div>
    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom flex-wrap gap-2">
            <div>
                <div class="fw-bold fs-5 mb-1">{{ $detailJadwal->matakuliah->nama_matakuliah ?? '-' }}</div>
                <span class="pill pill-gold">{{ $detailJadwal->kode_matakuliah }}</span>
            </div>
            <div class="d-flex gap-2">
                <span class="pill pill-maroon">{{ $detailJadwal->kelas }}</span>
                <span class="pill pill-olive">{{ $detailJadwal->hari }}</span>
            </div>
        </div>

        <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">Dosen Pengajar</dt>
            <dd class="col-sm-8">{{ $detailJadwal->dosen->nama ?? '-' }} ({{ $detailJadwal->nidn }})</dd>

            <dt class="col-sm-4 text-muted">Jam</dt>
            <dd class="col-sm-8">{{ \Carbon\Carbon::parse($detailJadwal->jam)->format('H:i') }} WIB</dd>

            <dt class="col-sm-4 text-muted">Ditambahkan</dt>
            <dd class="col-sm-8">{{ $detailJadwal->created_at->translatedFormat('d F Y, H:i') }}</dd>
        </dl>
    </div>
</div>
@endsection
