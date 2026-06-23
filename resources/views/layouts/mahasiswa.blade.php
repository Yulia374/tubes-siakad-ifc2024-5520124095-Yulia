@extends('layouts.app')

@section('body')
<nav class="navbar navbar-expand-lg navbar-mahasiswa navbar-dark">
    <div class="container">
        <a class="navbar-brand brand-font fw-bold" href="{{ route('dashboard.mahasiswa') }}">
            <i class="bi bi-mortarboard-fill"></i> SIAKAD
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMhs">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMhs">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.mahasiswa') ? 'active' : '' }}" href="{{ route('dashboard.mahasiswa') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('jadwal-saya*') ? 'active' : '' }}" href="{{ route('jadwal.mahasiswa.index') }}">
                        <i class="bi bi-calendar3"></i> Jadwal Kuliah
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('krs-saya*') ? 'active' : '' }}" href="{{ route('krs.mahasiswa.index') }}">
                        <i class="bi bi-card-checklist"></i> KRS Saya
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <span class="nav-link d-flex align-items-center gap-2">
                        <div class="avatar-circle avatar-circle-light" style="width: 30px; height: 30px; font-size: .74rem;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <span class="text-white-50">{{ auth()->user()->name }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container content-wrap">
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
@endsection
