@extends('layouts.admin')

@section('page-title', isset($detailMatakuliah) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">{{ isset($detailMatakuliah) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah' }}</h4>
    </div>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <form method="POST" action="{{ isset($detailMatakuliah) ? route('matakuliah.update', ['kode' => $detailMatakuliah->kode_matakuliah]) : route('matakuliah.store') }}">
            @csrf
            @if(isset($detailMatakuliah))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Mata Kuliah</label>
                <input type="text" class="form-control @error('kode_matakuliah') is-invalid @enderror" name="kode_matakuliah"
                    value="{{ old('kode_matakuliah', $detailMatakuliah->kode_matakuliah ?? '') }}"
                    maxlength="8"
                    placeholder="Contoh: MK000006"
                    {{ isset($detailMatakuliah) ? 'readonly' : '' }}>
                @error('kode_matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Mata Kuliah</label>
                <input type="text" class="form-control @error('nama_matakuliah') is-invalid @enderror" name="nama_matakuliah"
                    value="{{ old('nama_matakuliah', $detailMatakuliah->nama_matakuliah ?? '') }}"
                    maxlength="50"
                    placeholder="Contoh: Pemrograman Web Lanjutan">
                @error('nama_matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">SKS</label>
                <input type="number" class="form-control @error('sks') is-invalid @enderror" name="sks"
                    value="{{ old('sks', $detailMatakuliah->sks ?? '') }}"
                    min="1" max="6">
                @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-maroon">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
