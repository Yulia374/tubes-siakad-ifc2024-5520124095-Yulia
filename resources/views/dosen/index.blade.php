@extends('layouts.admin')

@section('page-title', 'Data Dosen')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Data Dosen</h4>
    </div>
    <a href="{{ route('dosen.create') }}" class="btn btn-maroon btn-sm">
        <i class="bi bi-plus-circle"></i> Tambah Dosen
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('dosen.index') }}" class="mb-3">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari NIDN atau nama...">
                @if(request('search'))
                    <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        @if($dataDosen->isEmpty())
            <div class="empty-state">
                <i class="bi bi-person-badge"></i>
                <p>{{ request('search') ? 'Tidak ada dosen yang cocok dengan pencarian.' : 'Belum ada data dosen.' }}</p>
                @if(!request('search'))
                <a href="{{ route('dosen.create') }}" class="btn btn-maroon btn-sm">Tambah Dosen Sekarang</a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="6%">No</th>
                            <th width="22%">NIDN</th>
                            <th width="54%">Nama</th>
                            <th class="text-end" width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataDosen as $item)
                        <tr>
                            <td class="text-center">{{ $dataDosen->firstItem() + $loop->index }}</td>
                            <td><span class="pill pill-gold">{{ $item->nidn }}</span></td>
                            <td class="d-flex align-items-center gap-2">
                                <div class="avatar-circle" style="width: 30px; height: 30px; font-size: .74rem;">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                {{ $item->nama }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('dosen.detail', ['nidn' => $item->nidn]) }}" class="btn btn-outline-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('dosen.edit', ['nidn' => $item->nidn]) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dosen.delete', ['nidn' => $item->nidn]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data dosen ini?')">
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

            {!! $dataDosen->links('components.pagination') !!}
        @endif
    </div>
</div>
@endsection
