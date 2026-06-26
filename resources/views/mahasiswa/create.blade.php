@extends('layouts.admin')

@section('page-title', isset($detailMahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">{{ isset($detailMahasiswa) ? 'Edit Data Mahasiswa' : 'Tambah Data Mahasiswa' }}</h4>
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <form method="POST" action="{{ isset($detailMahasiswa) ? route('mahasiswa.update', ['npm' => $detailMahasiswa->npm]) : route('mahasiswa.store') }}">
            @csrf
            @if(isset($detailMahasiswa))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">NPM</label>
                <input type="text" class="form-control @error('npm') is-invalid @enderror" name="npm"
                    value="{{ old('npm', $detailMahasiswa->npm ?? '') }}"
                    maxlength="10"
                    placeholder="Contoh: 2024001001"
                    {{ isset($detailMahasiswa) ? 'readonly' : '' }}>
                @error('npm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(!isset($detailMahasiswa))
                    <div class="form-text">NPM ini nantinya digunakan mahasiswa untuk mendaftar akun login.</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Dosen Wali</label>
                <select name="nidn" class="form-select @error('nidn') is-invalid @enderror">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->nidn }}"
                            {{ old('nidn', $detailMahasiswa->nidn ?? '') == $d->nidn ? 'selected' : '' }}>
                            {{ $d->nama }} ({{ $d->nidn }})
                        </option>
                    @endforeach
                </select>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kelas</label>
                <select name="kelas" class="form-select @error('kelas') is-invalid @enderror">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach(['A', 'B', 'C', 'D'] as $k)
                        <option value="{{ $k }}"
                            {{ old('kelas', $detailMahasiswa->kelas ?? '') == $k ? 'selected' : '' }}>
                            Kelas {{ $k }}
                        </option>
                    @endforeach
                </select>
                @error('kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Mahasiswa</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    value="{{ old('nama', $detailMahasiswa->nama ?? '') }}"
                    maxlength="50"
                    placeholder="Nama lengkap mahasiswa">
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
