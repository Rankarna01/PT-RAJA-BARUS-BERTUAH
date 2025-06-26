@extends('admin.layouts.app')
@section('title', 'Data Pemesanan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manajemen Data Pemesanan</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Tiket</th>
                            <th>Pelanggan</th>
                            <th>Jadwal & Rute</th>
                            <th>Total Bayar</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_pemesanan as $pesanan)
                        <tr>
                            <td><strong>{{ $pesanan->nomor_tiket }}</strong></td>
                            <td>
                                {{ $pesanan->nama_penumpang }}
                                <br>
                                <small class="text-muted">{{ $pesanan->user->email }}</small>
                            </td>
                            <td>
                                {{ $pesanan->perjalanan->rutePerjalanan->asal }} &rarr; {{ $pesanan->perjalanan->rutePerjalanan->tujuan }}
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($pesanan->perjalanan->tanggal_berangkat)->format('d M Y, H:i') }}</small>
                            </td>
                            <td>Rp {{ number_format($pesanan->total_pembayaran) }}</td>
                            <td>
                                {{-- FORM UNTUK UPDATE STATUS --}}
                                <form action="{{ route('admin.pemesanan.updateStatus', $pesanan->id) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <select name="status_pembayaran" class="form-select form-select-sm">
                                            <option value="menunggu" {{ $pesanan->status_pembayaran == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="lunas" {{ $pesanan->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="gagal" {{ $pesanan->status_pembayaran == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                            <option value="batal" {{ $pesanan->status_pembayaran == 'batal' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-primary" title="Update Status">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                {{-- Tombol Show (Link biasa) --}}
                                <a href="{{ route('admin.pemesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                {{-- Tombol Hapus (sekarang menjadi link biasa ke halaman konfirmasi) --}}
                                <a href="{{ route('admin.pemesanan.showDeleteConfirmation', $pesanan->id) }}" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data pemesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $semua_pemesanan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
