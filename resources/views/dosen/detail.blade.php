@extends('layouts.admin')

@section('page-title', 'Detail Dosen')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Detail Dosen</h4>
    </div>
    <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
            <div class="avatar-circle" style="width: 56px; height: 56px; font-size: 1.4rem;">{{ strtoupper(substr($detailDosen->nama, 0, 1)) }}</div>
            <div>
                <div class="fw-bold fs-5">{{ $detailDosen->nama }}</div>
                <span class="pill pill-gold">{{ $detailDosen->nidn }}</span>
            </div>
        </div>

        <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">Jumlah Mahasiswa Bimbingan</dt>
            <dd class="col-sm-8">{{ $detailDosen->mahasiswa()->count() }} orang</dd>

            <dt class="col-sm-4 text-muted">Jumlah Jadwal Mengajar</dt>
            <dd class="col-sm-8">{{ $detailDosen->jadwal()->count() }} kelas</dd>

            <dt class="col-sm-4 text-muted">Ditambahkan</dt>
            <dd class="col-sm-8">{{ $detailDosen->created_at->translatedFormat('d F Y, H:i') }}</dd>
        </dl>
    </div>
</div>
@endsection
