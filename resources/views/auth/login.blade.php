@extends('layouts.app')

@section('body')
<div class="d-flex" style="min-height: 100vh;">
    <div class="d-none d-lg-flex flex-column justify-content-between p-5 text-white"
         style="width: 42%; background: linear-gradient(160deg, var(--siakad-maroon) 0%, var(--siakad-maroon-dark) 100%); position: relative; overflow: hidden;">
        <div style="position: absolute; right: -60px; top: -60px; width: 280px; height: 280px; border-radius: 50%; background: rgba(255,255,255,.06);"></div>
        <div style="position: absolute; right: 40px; bottom: 80px; width: 160px; height: 160px; border-radius: 50%; background: rgba(255,255,255,.05);"></div>

        <div class="d-flex align-items-center gap-2" style="z-index: 1;">
            <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <span class="brand-font fw-bold fs-5">SIAKAD</span>
        </div>

        <div style="z-index: 1;">
            <h2 class="brand-font fw-bold mb-3" style="font-size: 2rem;">Satu sistem,<br>seluruh urusan akademik.</h2>
            <p class="text-white-50">Kelola data dosen, mahasiswa, mata kuliah, jadwal, dan KRS dalam satu tempat yang rapi dan mudah diakses.</p>
        </div>

        <div class="text-white-50 small" style="z-index: 1;">&copy; {{ date('Y') }} Universitas Suryakancana</div>
    </div>

    <div class="d-flex align-items-center justify-content-center flex-grow-1 p-4" style="background: var(--siakad-bg);">
        <div style="width: 100%; max-width: 400px;">
            <div class="d-lg-none text-center mb-4">
                <i class="bi bi-mortarboard-fill" style="font-size: 2.2rem; color: var(--siakad-maroon);"></i>
                <h4 class="brand-font fw-bold mt-2 mb-0">SIAKAD</h4>
            </div>

            <div class="page-eyebrow">Masuk ke akun Anda</div>
            <h3 class="brand-font fw-bold mb-1">Selamat Datang</h3>
            <p class="text-muted small mb-4">Masuk menggunakan email dan password Anda.</p>

            @if(session('success'))
                <div class="alert alert-success py-2 small">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="nama@email.com" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-maroon w-100 mt-2">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk
                </button>
            </form>

            <p class="text-center text-muted small mt-4 mb-0">
                Belum punya akun mahasiswa? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: var(--siakad-maroon);">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
