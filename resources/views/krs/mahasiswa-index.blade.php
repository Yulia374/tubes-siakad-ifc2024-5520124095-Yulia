@extends('layouts.mahasiswa')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <div>
        <div class="page-eyebrow">Kartu Rencana Studi</div>
        <h4 class="brand-font mb-0">KRS Saya</h4>
        <p class="text-muted small mb-0">
            <span class="pill pill-maroon">{{ $jumlahMatkul }} Mata Kuliah</span>
            <span class="pill pill-gold">{{ $totalSks }} SKS</span>
        </p>
    </div>
    <div class="d-flex gap-2">
        @if($dataKrs->isNotEmpty())
        <a href="{{ route('krs.mahasiswa.export.pdf') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
        @endif
        <a href="{{ route('krs.mahasiswa.create') }}" class="btn btn-maroon btn-sm">
            <i class="bi bi-plus-circle"></i> Ambil Mata Kuliah
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($dataKrs->isEmpty())
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>Anda belum mengambil mata kuliah apapun.</p>
                <a href="{{ route('krs.mahasiswa.create') }}" class="btn btn-maroon btn-sm">Ambil Mata Kuliah Sekarang</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="6%">No</th>
                            <th width="18%">Kode</th>
                            <th width="44%">Mata Kuliah</th>
                            <th class="text-center" width="12%">SKS</th>
                            <th class="text-end" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataKrs as $item)
                        <tr>
                            <td class="text-center">{{ $dataKrs->firstItem() + $loop->index }}</td>
                            <td><span class="pill pill-gold">{{ $item->kode_matakuliah }}</span></td>
                            <td class="fw-medium">{{ $item->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td class="text-center">{{ $item->matakuliah->sks ?? '-' }}</td>
                            <td class="text-end">
                                <form action="{{ route('krs.mahasiswa.delete', ['id' => $item->id]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin drop mata kuliah ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Drop
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {!! $dataKrs->links('components.pagination') !!}
        @endif
    </div>
</div>
@endsection
