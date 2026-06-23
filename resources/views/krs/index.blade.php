@extends('layouts.admin')

@section('page-title', 'Data KRS')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Data KRS Seluruh Mahasiswa</h4>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('krs.export.pdf') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
        <a href="{{ route('krs.export.excel') }}" class="btn btn-outline-success btn-sm">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('krs.index') }}" class="mb-3">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari NPM, nama, mata kuliah...">
                @if(request('search'))
                    <a href="{{ route('krs.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        @if($dataKrs->isEmpty())
            <div class="empty-state">
                <i class="bi bi-card-checklist"></i>
                <p class="mb-0">{{ request('search') ? 'Tidak ada KRS yang cocok dengan pencarian.' : 'Belum ada mahasiswa yang mengisi KRS.' }}</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="6%">No</th>
                            <th width="15%">NPM</th>
                            <th width="26%">Nama Mahasiswa</th>
                            <th width="28%">Mata Kuliah</th>
                            <th class="text-center" width="10%">SKS</th>
                            <th class="text-end" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataKrs as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><span class="pill pill-gold">{{ $item->npm }}</span></td>
                            <td class="d-flex align-items-center gap-2">
                                <div class="avatar-circle" style="width: 30px; height: 30px; font-size: .74rem;">{{ strtoupper(substr($item->mahasiswa->nama ?? '?', 0, 1)) }}</div>
                                {{ $item->mahasiswa->nama ?? '-' }}
                            </td>
                            <td>{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="text-center"><span class="pill pill-maroon">{{ $item->matakuliah->sks ?? '-' }} SKS</span></td>
                            <td class="text-end">
                                <a href="{{ route('krs.detail', ['id' => $item->id]) }}" class="btn btn-outline-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('krs.delete', ['id' => $item->id]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data KRS ini?')">
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
