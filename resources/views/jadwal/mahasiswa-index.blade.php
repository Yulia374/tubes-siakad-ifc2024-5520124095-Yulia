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
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i>
                    Jadwal di bawah ini hanya menampilkan kelas Anda sendiri (Kelas {{ Auth::user()->mahasiswa->kelas ?? '-' }}).
                </p>

                @foreach($dataJadwal as $kodeMk => $jadwalPerMk)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="pill pill-gold">{{ $kodeMk }}</span>
                        <span class="fw-semibold">{{ $jadwalPerMk->first()->matakuliah->nama_matakuliah ?? '-' }}</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="12%">Kelas</th>
                                    <th width="38%">Dosen</th>
                                    <th width="20%">Hari</th>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalPerMk as $item)
                                <tr>
                                    <td class="text-center"><span class="pill pill-maroon">{{ $item->kelas }}</span></td>
                                    <td>{{ $item->dosen->nama ?? '-' }}</td>
                                    <td><span class="pill pill-olive">{{ $item->hari }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach

                {!! $dataJadwal->links('components.pagination') !!}
            @endif
        @endif
    </div>
</div>
@endsection
