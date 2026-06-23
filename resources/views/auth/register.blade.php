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
            <h2 class="brand-font fw-bold mb-3" style="font-size: 2rem;">Daftar sekali,<br>akses sepanjang semester.</h2>
            <p class="text-white-50 mb-0">Pastikan NPM Anda sudah didaftarkan oleh admin sebelum membuat akun.</p>
        </div>

        <div class="text-white-50 small" style="z-index: 1;">&copy; {{ date('Y') }} Universitas Suryakancana</div>
    </div>

    <div class="d-flex align-items-center justify-content-center flex-grow-1 p-4 py-5" style="background: var(--siakad-bg);">
        <div style="width: 100%; max-width: 420px;">
            <div class="d-lg-none text-center mb-4">
                <i class="bi bi-person-plus-fill" style="font-size: 2.2rem; color: var(--siakad-maroon);"></i>
                <h4 class="brand-font fw-bold mt-2 mb-0">SIAKAD</h4>
            </div>

            <div class="page-eyebrow">Akun Mahasiswa</div>
            <h3 class="brand-font fw-bold mb-1">Buat Akun Baru</h3>
            <p class="text-muted small mb-4">NPM Anda harus sudah terdaftar oleh admin.</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.attempt') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">NPM</label>
                    <input type="text" name="npm" value="{{ old('npm') }}" class="form-control" placeholder="Contoh: 2024001001" maxlength="10" required>
                    <div class="form-text">Hubungi admin jika NPM Anda belum terdaftar di sistem.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nama lengkap Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="nama@email.com" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label small fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label small fw-semibold">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-maroon w-100 mt-2">
                    <i class="bi bi-check-circle"></i> Daftar
                </button>
            </form>

            <p class="text-center text-muted small mt-4 mb-0">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: var(--siakad-maroon);">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
