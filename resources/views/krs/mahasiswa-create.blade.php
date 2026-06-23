@extends('layouts.mahasiswa')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Kartu Rencana Studi</div>
        <h4 class="brand-font mb-0">Ambil Mata Kuliah</h4>
    </div>
    <a href="{{ route('krs.mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($matakuliah->isEmpty())
            <div class="empty-state">
                <i class="bi bi-check2-circle"></i>
                <p class="mb-0">Anda sudah mengambil semua mata kuliah yang tersedia.</p>
            </div>
        @else
            <p class="text-muted small mb-3">Pilih salah satu mata kuliah di bawah ini, lalu klik <strong>Ambil Mata Kuliah Ini</strong>.</p>

            <form method="POST" action="{{ route('krs.mahasiswa.store') }}" id="formAmbilMk">
                @csrf

                @error('kode_matakuliah')
                    <div class="alert alert-danger small py-2">{{ $message }}</div>
                @enderror

                <div class="row g-3 mb-3">
                    @foreach($matakuliah as $mk)
                    <div class="col-md-6 col-lg-4">
                        <label class="mk-pick-card d-block p-3 rounded-3 h-100" style="cursor: pointer; border: 1px solid var(--siakad-border); transition: border-color .15s ease, background .15s ease;">
                            <input type="radio" name="kode_matakuliah" value="{{ $mk->kode_matakuliah }}" class="d-none mk-pick-input"
                                {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'checked' : '' }} required>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="pill pill-gold">{{ $mk->kode_matakuliah }}</span>
                                <i class="bi bi-circle mk-pick-icon fs-5 text-muted"></i>
                            </div>
                            <div class="fw-semibold mb-1">{{ $mk->nama_matakuliah }}</div>
                            <div class="text-muted small">{{ $mk->sks }} SKS</div>
                        </label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-maroon">
                    <i class="bi bi-check-circle"></i> Ambil Mata Kuliah Ini
                </button>
            </form>
        @endif
    </div>
</div>

@push('styles')
<style>
    .mk-pick-card:hover {
        border-color: var(--siakad-maroon) !important;
        background: var(--siakad-maroon-light);
    }

    .mk-pick-input:checked ~ * .mk-pick-icon,
    .mk-pick-card:has(.mk-pick-input:checked) {
        border-color: var(--siakad-maroon) !important;
        background: var(--siakad-maroon-light);
    }

    .mk-pick-card:has(.mk-pick-input:checked) .mk-pick-icon::before {
        content: "\f26a";
        color: var(--siakad-maroon);
    }
</style>
@endpush
@endsection
