@extends('layouts.mahasiswa')

@section('content')
@php
    $jam = now()->hour;
    $sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));
@endphp

<div class="page-eyebrow">{{ now()->translatedFormat('l, d F Y') }}</div>
<h3 class="brand-font mb-1">{{ $sapaan }}, {{ auth()->user()->name }} 👋</h3>

@if (!$mahasiswa)
    <div class="alert alert-warning d-flex align-items-center gap-2 mt-3">
        <i class="bi bi-exclamation-triangle-fill"></i>
        Akun Anda belum terhubung dengan data mahasiswa manapun. Hubungi admin untuk pengecekan NPM.
    </div>
@else
    <p class="text-muted mb-4">
        <span class="pill pill-gold"><i class="bi bi-credit-card-2-front"></i> {{ $mahasiswa->npm }}</span>
        &nbsp;Dosen Wali: <strong>{{ $mahasiswa->dosen->nama ?? '-' }}</strong>
    </p>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon"><i class="bi bi-card-checklist"></i></div>
                <div>
                    <div class="stat-number">{{ $krsList->count() }}</div>
                    <div class="stat-label">Mata Kuliah Diambil</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#c98a2c;"><i class="bi bi-stack"></i></div>
                <div>
                    <div class="stat-number">{{ $totalSks }}</div>
                    <div class="stat-label">Total SKS</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5 order-lg-2">
            <div class="card h-100">
                <div class="card-header"><i class="bi bi-calendar-event"></i> Kuliah Hari Ini</div>
                <div class="card-body">
                    @if($jadwalHariIni->isEmpty())
                        <div class="empty-state py-3">
                            <i class="bi bi-cup-hot"></i>
                            <p class="mb-0">Tidak ada kuliah terjadwal hari ini. Selamat bersantai!</p>
                        </div>
                    @else
                        <ul class="list-unstyled mb-0">
                            @foreach($jadwalHariIni as $jdw)
                            <li class="d-flex gap-3 {{ !$loop->last ? 'pb-3 mb-3 border-bottom' : '' }}">
                                <div class="pill pill-olive text-nowrap" style="height: fit-content;">{{ \Carbon\Carbon::parse($jdw->jam)->format('H:i') }}</div>
                                <div>
                                    <div class="fw-semibold small">{{ $jdw->matakuliah->nama_matakuliah ?? '-' }}</div>
                                    <div class="text-muted small">{{ $jdw->dosen->nama ?? '-' }} &middot; Kelas {{ $jdw->kelas }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-7 order-lg-1">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-bookmark"></i> Mata Kuliah yang Diambil</span>
                    <a href="{{ route('krs.mahasiswa.create') }}" class="btn btn-maroon btn-sm"><i class="bi bi-plus-circle"></i> Ambil Mata Kuliah</a>
                </div>
                <div class="card-body">
                    @if ($krsList->isEmpty())
                        <div class="empty-state py-3">
                            <i class="bi bi-inbox"></i>
                            <p>Anda belum mengambil mata kuliah apapun.</p>
                            <a href="{{ route('krs.mahasiswa.create') }}" class="btn btn-maroon btn-sm">Ambil Mata Kuliah Sekarang</a>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach ($krsList as $krs)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: var(--siakad-bg);">
                                    <div class="pill pill-maroon">{{ $krs->matakuliah->sks ?? '-' }} SKS</div>
                                    <div>
                                        <div class="fw-semibold small">{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</div>
                                        <div class="text-muted small">{{ $krs->kode_matakuliah }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
