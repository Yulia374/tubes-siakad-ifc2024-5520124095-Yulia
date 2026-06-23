@extends('layouts.admin')

@section('page-title', 'Jadwal Kuliah')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <div class="page-eyebrow">Data Akademik</div>
        <h4 class="brand-font mb-0">Jadwal Perkuliahan</h4>
    </div>
    <a href="{{ route('jadwal.create') }}" class="btn btn-maroon btn-sm">
        <i class="bi bi-plus-circle"></i> Tambah Jadwal
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('jadwal.index') }}" class="mb-3">
            <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari mata kuliah, dosen, hari...">
                @if(request('search'))
                    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        @if($dataJadwal->isEmpty())
            <div class="empty-state">
                <i class="bi bi-calendar-x"></i>
                <p>{{ request('search') ? 'Tidak ada jadwal yang cocok dengan pencarian.' : 'Belum ada data jadwal kuliah.' }}</p>
                @if(!request('search'))
                <a href="{{ route('jadwal.create') }}" class="btn btn-maroon btn-sm">Tambah Jadwal Sekarang</a>
                @endif
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="26%">Mata Kuliah</th>
                            <th width="20%">Dosen</th>
                            <th class="text-center" width="9%">Kelas</th>
                            <th width="13%">Hari</th>
                            <th width="10%">Jam</th>
                            <th class="text-end" width="17%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataJadwal as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td>{{ $item->dosen->nama ?? '-' }}</td>
                            <td class="text-center"><span class="pill pill-maroon">{{ $item->kelas }}</span></td>
                            <td><span class="pill pill-olive">{{ $item->hari }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('jadwal.detail', ['id' => $item->id]) }}" class="btn btn-outline-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('jadwal.edit', ['id' => $item->id]) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('jadwal.delete', ['id' => $item->id]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
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
