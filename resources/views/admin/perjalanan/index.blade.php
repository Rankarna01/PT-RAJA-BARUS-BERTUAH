@extends('admin.layouts.app')
@section('title', 'Daftar Penjadwalan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Penjadwalan Perjalanan</h1>
        <a href="{{ route('admin.perjalanan.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Buat Jadwal Perjalanan
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #0d6efd; color: white;">
            <h6 class="m-0 font-weight-bold">Semua Perjalanan Terjadwal</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal & Waktu</th>
                            <th>Rute</th>
                            <th>Mobil</th>
                            <th>Supir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_perjalanan as $index => $perjalanan)
                        <tr>
                            <td>{{ $semua_perjalanan->firstItem() + $index }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($perjalanan->tanggal_berangkat)->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($perjalanan->jam_berangkat)->format('H:i') }} WIB</small>
                            </td>
                            <td>{{ $perjalanan->rutePerjalanan->asal }} - {{ $perjalanan->rutePerjalanan->tujuan }}</td>
                            <td>{{ $perjalanan->mobil->nama_mobil }} ({{ $perjalanan->mobil->nomor_polisi }})</td>
                            <td>{{ $perjalanan->mobil->nama_supir }}</td>
                            <td>
                                <form action="{{ route('admin.perjalanan.toggleStatus', $perjalanan->id) }}" method="POST">
                                    @csrf
                                    @if ($perjalanan->status == 'Tersedia')
                                        <button type="submit" class="btn btn-sm btn-success">Tersedia</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-secondary">Tidak Tersedia</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.perjalanan.edit', $perjalanan->id) }}" class="btn btn-sm btn-info" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- PERBAIKAN DI SINI: Komentar dihapus agar link aktif --}}
                                <a href="{{ route('admin.perjalanan.showDeleteConfirmation', $perjalanan->id) }}" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada perjalanan yang dijadwalkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                 {{ $semua_perjalanan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
