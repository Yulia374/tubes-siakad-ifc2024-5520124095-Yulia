@extends('layouts.mahasiswa')

@section('content')
<div class="page-eyebrow">Akademik</div>
<h4 class="brand-font mb-3">Jadwal Kuliah Saya</h4>

<div class="card">
    <div class="card-body">
        @if($dataJadwal->isEmpty() && !request('search'))
            <div class="empty-state">
                <i class="bi bi-calendar-x"></i>
                <p>Anda belum punya jadwal kuliah karena belum mengambil mata kuliah apapun.</p>
                <a href="{{ route('krs.mahasiswa.create') }}" class="btn btn-maroon btn-sm">Ambil Mata Kuliah Sekarang</a>
            </div>
        @else
            <form method="GET" action="{{ route('jadwal.mahasiswa.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 320px;">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari mata kuliah, dosen, hari...">
                    @if(request('search'))
                        <a href="{{ route('jadwal.mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>

            @if($dataJadwal->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <p class="mb-0">Tidak ada jadwal yang cocok dengan pencarian.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="6%">No</th>
                                <th width="28%">Mata Kuliah</th>
                                <th width="24%">Dosen</th>
                                <th class="text-center" width="14%">Kelas</th>
                                <th width="14%">Hari</th>
                                <th>Jam</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
