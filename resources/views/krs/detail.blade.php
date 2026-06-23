@extends('layouts.admin')

@section('page-title', 'Detail KRS')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Detail KRS</h4>
    </div>
    <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
            <div class="avatar-circle" style="width: 56px; height: 56px; font-size: 1.4rem;">{{ strtoupper(substr($detailKrs->mahasiswa->nama ?? '?', 0, 1)) }}</div>
            <div>
                <div class="fw-bold fs-5">{{ $detailKrs->mahasiswa->nama ?? '-' }}</div>
                <span class="pill pill-gold">{{ $detailKrs->npm }}</span>
            </div>
        </div>

        <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">Mata Kuliah</dt>
            <dd class="col-sm-8">{{ $detailKrs->matakuliah->nama_matakuliah ?? '-' }} ({{ $detailKrs->kode_matakuliah }})</dd>

            <dt class="col-sm-4 text-muted">SKS</dt>
            <dd class="col-sm-8"><span class="pill pill-maroon">{{ $detailKrs->matakuliah->sks ?? '-' }} SKS</span></dd>

            <dt class="col-sm-4 text-muted">Diambil Pada</dt>
            <dd class="col-sm-8">{{ $detailKrs->created_at->translatedFormat('d F Y, H:i') }}</dd>
        </dl>
    </div>
</div>
@endsection
