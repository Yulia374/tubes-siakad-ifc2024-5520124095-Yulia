@extends('layouts.admin')

@section('page-title', 'Detail Mata Kuliah')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Detail Mata Kuliah</h4>
    </div>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
            <div>
                <div class="fw-bold fs-5 mb-1">{{ $detailMatakuliah->nama_matakuliah }}</div>
                <span class="pill pill-gold">{{ $detailMatakuliah->kode_matakuliah }}</span>
            </div>
            <span class="pill pill-maroon">{{ $detailMatakuliah->sks }} SKS</span>
        </div>

        <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">Jumlah Jadwal</dt>
            <dd class="col-sm-8">{{ $detailMatakuliah->jadwal()->count() }} kelas</dd>

            <dt class="col-sm-4 text-muted">Diambil Mahasiswa</dt>
            <dd class="col-sm-8">{{ $detailMatakuliah->krs()->count() }} mahasiswa</dd>

            <dt class="col-sm-4 text-muted">Ditambahkan</dt>
            <dd class="col-sm-8">{{ $detailMatakuliah->created_at->translatedFormat('d F Y, H:i') }}</dd>
        </dl>
    </div>
</div>
@endsection
