@extends('admin.layouts.app')
@section('title', 'Laporan Pendapatan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Pendapatan</h1>

    <!-- Form Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
        </div>
        <div class="card-body">
            {{-- Form untuk filter tampilan --}}
            <form action="{{ route('admin.laporan.index') }}" method="GET" id="filterForm">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="tipe" class="form-label">Tipe Laporan</label>
                        <select name="tipe" id="tipe" class="form-select">
                            <option value="harian" {{ $tipeLaporan == 'harian' ? 'selected' : '' }}>Harian</option>
                            <option value="bulanan" {{ $tipeLaporan == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            <option value="tahunan" {{ $tipeLaporan == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                    </div>

                    <!-- Filter Harian -->
                    <div class="col-md-3 filter-group" id="filter-harian">
                        <label for="tanggal" class="form-label">Pilih Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal }}">
                    </div>

                    <!-- Filter Bulanan -->
                    <div class="col-md-4 filter-group" id="filter-bulanan" style="display: none;">
                        <label for="bulan" class="form-label">Pilih Bulan & Tahun</label>
                        <div class="input-group">
                            <select name="bulan" id="bulan" class="form-select">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                                @endfor
                            </select>
                            {{-- Nama input tahun ini dibedakan agar tidak bentrok --}}
                            <input type="number" name="tahun_for_bulan" class="form-control" placeholder="Tahun" value="{{ $tahun }}">
                        </div>
                    </div>

                    <!-- Filter Tahunan -->
                    <div class="col-md-3 filter-group" id="filter-tahunan" style="display: none;">
                        <label for="tahun" class="form-label">Pilih Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Contoh: 2025" value="{{ $tahun }}">
                    </div>

                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        {{-- Tombol Cetak PDF sekarang menjadi link biasa --}}
                        <a href="{{-- URL akan diisi oleh JavaScript --}}" id="cetakPdfBtn" class="btn btn-success" target="_blank">
                            <i class="bi bi-printer-fill"></i> Cetak PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hasil Laporan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Laporan</h6>
            <h6 class="m-0 font-weight-bold">Total Pendapatan: <span class="text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Tiket</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th class="text-end">Total Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nomor_tiket }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td class="text-end">Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data pendapatan untuk periode yang dipilih.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const tipeSelect = document.getElementById('tipe');
    const filterGroups = document.querySelectorAll('.filter-group');
    const cetakPdfBtn = document.getElementById('cetakPdfBtn');
    const filterForm = document.getElementById('filterForm');

    function toggleFilters() {
        const tipe = tipeSelect.value;
        filterGroups.forEach(group => group.style.display = 'none');
        
        if (tipe === 'harian') {
            document.getElementById('filter-harian').style.display = 'block';
        } else if (tipe === 'bulanan') {
            document.getElementById('filter-bulanan').style.display = 'block';
        } else if (tipe === 'tahunan') {
            document.getElementById('filter-tahunan').style.display = 'block';
        }
    }

    // Fungsi untuk memperbarui link cetak PDF secara dinamis
    function updateCetakLink() {
        // Ambil semua data dari form filter
        const params = new URLSearchParams(new FormData(filterForm)).toString();
        // Atur href dari tombol cetak dengan parameter yang sama
        cetakPdfBtn.href = `{{ route('admin.laporan.cetakPdf') }}?${params}`;
    }

    // Tambahkan event listener untuk mengubah filter dan link cetak
    filterForm.addEventListener('change', () => {
        toggleFilters();
        updateCetakLink();
    });
    
    // Panggil fungsi saat halaman dimuat untuk memastikan tampilan dan link awal sudah benar
    toggleFilters();
    updateCetakLink();
});
</script>
@endpush
