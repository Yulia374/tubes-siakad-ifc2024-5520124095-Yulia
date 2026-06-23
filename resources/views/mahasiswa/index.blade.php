@extends('layouts.admin')

@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Data Mahasiswa</h4>
    </div>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-maroon btn-sm">
        <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-3">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari NPM atau nama...">
                @if(request('search'))
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        @if($dataMahasiswa->isEmpty())
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <p>{{ request('search') ? 'Tidak ada data mahasiswa yang cocok dengan pencarian.' : 'Belum ada data mahasiswa.' }}</p>
                @if(!request('search'))
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-maroon btn-sm">Tambah Mahasiswa Sekarang</a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="6%">No</th>
                            <th width="16%">NPM</th>
                            <th width="32%">Nama</th>
                            <th width="28%">Dosen Wali</th>
                            <th class="text-end" width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataMahasiswa as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><span class="pill pill-gold">{{ $item->npm }}</span></td>
                            <td class="d-flex align-items-center gap-2">
                                <div class="avatar-circle" style="width: 30px; height: 30px; font-size: .74rem;">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                {{ $item->nama }}
                            </td>
                            <td>{{ $item->dosen->nama ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('mahasiswa.detail', ['npm' => $item->npm]) }}" class="btn btn-outline-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('mahasiswa.edit', ['npm' => $item->npm]) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('mahasiswa.delete', ['npm' => $item->npm]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
