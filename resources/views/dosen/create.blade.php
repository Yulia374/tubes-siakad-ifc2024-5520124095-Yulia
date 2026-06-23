@extends('layouts.admin')

@section('page-title', isset($detailDosen) ? 'Edit Dosen' : 'Tambah Dosen')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">{{ isset($detailDosen) ? 'Edit Data Dosen' : 'Tambah Data Dosen' }}</h4>
    </div>
    <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <form method="POST" action="{{ isset($detailDosen) ? route('dosen.update', ['nidn' => $detailDosen->nidn]) : route('dosen.store') }}">
            @csrf
            @if(isset($detailDosen))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">NIDN</label>
                <input type="text" class="form-control @error('nidn') is-invalid @enderror" name="nidn"
                    value="{{ old('nidn', $detailDosen->nidn ?? '') }}"
                    maxlength="10"
                    placeholder="Contoh: 0412345678"
                    {{ isset($detailDosen) ? 'readonly' : '' }}>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Dosen</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    value="{{ old('nama', $detailDosen->nama ?? '') }}"
                    maxlength="50"
                    placeholder="Nama lengkap dosen">
                @error('nama')
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
