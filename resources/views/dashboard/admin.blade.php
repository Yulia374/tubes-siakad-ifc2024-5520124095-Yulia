@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
@php
    $jam = now()->hour;
    $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));
@endphp

<div class="page-eyebrow">{{ now()->translatedFormat('l, d F Y') }}</div>
<h3 class="brand-font mb-1" style="font-size: 1.7rem;">{{ $sapaan }}, {{ auth()->user()->name }} 👋</h3>
<p class="text-muted mb-4">Berikut ringkasan data akademik SIAKAD saat ini.</p>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon"><i class="bi bi-person-badge"></i></div>
            <div>
                <div class="stat-number">{{ $totalDosen }}</div>
                <div class="stat-label">Dosen</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#c98a2c;"><i class="bi bi-people"></i></div>
            <div>
                <div class="stat-number">{{ $totalMahasiswa }}</div>
                <div class="stat-label">Mahasiswa</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#4a6741;"><i class="bi bi-journal-bookmark"></i></div>
            <div>
                <div class="stat-number">{{ $totalMatakuliah }}</div>
                <div class="stat-label">Mata Kuliah</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#2b5a7a;"><i class="bi bi-calendar3"></i></div>
            <div>
                <div class="stat-number">{{ $totalJadwal }}</div>
                <div class="stat-label">Jadwal Kuliah</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-clock-history"></i> Aktivitas KRS Terbaru</span>
                <a href="{{ route('krs.index') }}" class="small text-decoration-none">Lihat semua &rarr;</a>
            </div>
            <div class="card-body">
                @if($aktivitasTerbaru->isEmpty())
                    <div class="empty-state py-3">
                        <i class="bi bi-inbox"></i>
                        <p class="mb-0">Belum ada mahasiswa yang mengisi KRS.</p>
                    </div>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($aktivitasTerbaru as $item)
                        <li class="d-flex align-items-center gap-3 {{ !$loop->last ? 'pb-3 mb-3 border-bottom' : '' }}">
                            <div class="avatar-circle">{{ strtoupper(substr($item->mahasiswa->nama ?? '?', 0, 1)) }}</div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold small">{{ $item->mahasiswa->nama ?? 'Mahasiswa tidak ditemukan' }}</div>
                                <div class="text-muted small">mengambil <strong>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</strong></div>
                            </div>
                            <div class="text-muted small text-nowrap">{{ $item->created_at->diffForHumans() }}</div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header"><i class="bi bi-lightning-charge"></i> Akses Cepat</div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('dosen.create') }}" class="btn btn-outline-secondary btn-sm text-start"><i class="bi bi-plus-circle"></i> Tambah Dosen</a>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-outline-secondary btn-sm text-start"><i class="bi bi-plus-circle"></i> Tambah Mahasiswa</a>
                <a href="{{ route('matakuliah.create') }}" class="btn btn-outline-secondary btn-sm text-start"><i class="bi bi-plus-circle"></i> Tambah Mata Kuliah</a>
                <a href="{{ route('jadwal.create') }}" class="btn btn-outline-secondary btn-sm text-start"><i class="bi bi-plus-circle"></i> Tambah Jadwal</a>
                <hr class="my-1">
                <a href="{{ route('krs.export.pdf') }}" class="btn btn-outline-danger btn-sm text-start"><i class="bi bi-file-earmark-pdf"></i> Export Rekap KRS (PDF)</a>
                <a href="{{ route('krs.export.excel') }}" class="btn btn-outline-success btn-sm text-start"><i class="bi bi-file-earmark-excel"></i> Export Rekap KRS (Excel)</a>
            </div>
        </div>
    </div>
</div>
@endsection
