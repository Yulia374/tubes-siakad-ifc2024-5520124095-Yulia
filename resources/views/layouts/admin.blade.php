@extends('layouts.app')

@section('body')
<div class="d-flex">
    <aside class="sidebar">
        <div class="brand">
            <div class="d-flex align-items-center gap-2">
                <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
                <div>
                    <div class="fw-bold brand-font" style="font-size: 1.05rem;">SIAKAD</div>
                    <small>Universitas Suryakancana</small>
                </div>
            </div>
        </div>

        <div class="nav-section-label">Menu Utama</div>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard.admin') }}" class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </nav>

        <div class="nav-section-label">Data Akademik</div>
        <nav class="nav flex-column">
            <a href="{{ route('dosen.index') }}" class="nav-link {{ request()->is('dosen*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Data Dosen
            </a>
            <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Data Mahasiswa
            </a>
            <a href="{{ route('matakuliah.index') }}" class="nav-link {{ request()->is('matakuliah*') ? 'active' : '' }}">
                <i class="bi bi-journal-bookmark"></i> Mata Kuliah
            </a>
            <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> Jadwal Kuliah
            </a>
            <a href="{{ route('krs.index') }}" class="nav-link {{ request()->is('krs*') ? 'active' : '' }}">
                <i class="bi bi-card-checklist"></i> Data KRS
            </a>
        </nav>

        <div class="sidebar-footer">
            Logged in sebagai Administrator
        </div>
    </aside>

    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center">
            <button class="btn btn-sm btn-outline-secondary d-md-none" type="button" onclick="document.querySelector('.sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
            <div>
                <div class="page-eyebrow d-none d-sm-block">SIAKAD &middot; Admin</div>
                <span class="fw-semibold" style="font-size: 1.05rem;">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-sm-flex align-items-center gap-2">
                    <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div class="lh-sm">
                        <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                        <div class="pill pill-maroon" style="font-size: .68rem; padding: .12rem .5rem;">Admin</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> <span class="d-none d-sm-inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="content-wrap">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

        <div class="footer-note">&copy; {{ date('Y') }} SIAKAD &mdash; Universitas Suryakancana</div>
    </div>
</div>
@endsection
