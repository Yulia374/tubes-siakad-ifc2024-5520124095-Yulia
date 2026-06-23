@extends('layouts.admin')

@section('page-title', isset($detailJadwal) ? 'Edit Jadwal' : 'Tambah Jadwal')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">{{ isset($detailJadwal) ? 'Edit Jadwal Kuliah' : 'Tambah Jadwal Kuliah' }}</h4>
    </div>
    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width: 760px;">
    <div class="card-body">
        <form method="POST" action="{{ isset($detailJadwal) ? route('jadwal.update', ['id' => $detailJadwal->id]) : route('jadwal.store') }}">
            @csrf
            @if(isset($detailJadwal))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold">Mata Kuliah</label>
                <select name="kode_matakuliah" class="form-select @error('kode_matakuliah') is-invalid @enderror">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                        <option value="{{ $mk->kode_matakuliah }}"
                            {{ old('kode_matakuliah', $detailJadwal->kode_matakuliah ?? '') == $mk->kode_matakuliah ? 'selected' : '' }}>
                            {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }})
                        </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Dosen Pengajar</label>
                <select name="nidn" class="form-select @error('nidn') is-invalid @enderror">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->nidn }}"
                            {{ old('nidn', $detailJadwal->nidn ?? '') == $d->nidn ? 'selected' : '' }}>
                            {{ $d->nama }} ({{ $d->nidn }})
                        </option>
                    @endforeach
                </select>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <select name="kelas" class="form-select @error('kelas') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach(['A','B','C','D','E'] as $k)
                            <option value="{{ $k }}"
                                {{ old('kelas', $detailJadwal->kelas ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Hari</label>
                    <select name="hari" class="form-select @error('hari') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                            <option value="{{ $h }}"
                                {{ old('hari', $detailJadwal->hari ?? '') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Jam</label>
                    <input type="time" class="form-control @error('jam') is-invalid @enderror" name="jam"
                        value="{{ old('jam', isset($detailJadwal) ? \Carbon\Carbon::parse($detailJadwal->jam)->format('H:i') : '') }}">
                    @error('jam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-maroon">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
