@extends('layouts.admin')

@section('page-title', 'Mata Kuliah')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Data Mata Kuliah</h4>
    </div>
    <a href="{{ route('matakuliah.create') }}" class="btn btn-maroon btn-sm">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('matakuliah.index') }}" class="mb-3">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari kode atau nama...">
                @if(request('search'))
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        @if($dataMatakuliah->isEmpty())
            <div class="empty-state">
                <i class="bi bi-journal-bookmark"></i>
                <p>{{ request('search') ? 'Tidak ada mata kuliah yang cocok dengan pencarian.' : 'Belum ada data mata kuliah.' }}</p>
                @if(!request('search'))
                <a href="{{ route('matakuliah.create') }}" class="btn btn-maroon btn-sm">Tambah Mata Kuliah Sekarang</a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="6%">No</th>
                            <th width="16%">Kode</th>
                            <th width="48%">Nama Mata Kuliah</th>
                            <th class="text-center" width="12%">SKS</th>
                            <th class="text-end" width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataMatakuliah as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><span class="pill pill-gold">{{ $item->kode_matakuliah }}</span></td>
                            <td class="fw-medium">{{ $item->nama_matakuliah }}</td>
                            <td class="text-center"><span class="pill pill-maroon">{{ $item->sks }} SKS</span></td>
                            <td class="text-end">
                                <a href="{{ route('matakuliah.detail', ['kode' => $item->kode_matakuliah]) }}" class="btn btn-outline-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('matakuliah.edit', ['kode' => $item->kode_matakuliah]) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('matakuliah.delete', ['kode' => $item->kode_matakuliah]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
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
