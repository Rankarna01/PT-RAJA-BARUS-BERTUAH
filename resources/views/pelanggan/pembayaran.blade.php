@extends('layouts.pelanggan')
@section('title', 'Pembayaran')

@section('content')
<div class="container my-4">
    @include('layouts.partials.progress_bar', ['tahap' => 3])

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4 p-lg-5 text-center">
            <i class="bi bi-shield-check-fill text-success display-3 mb-3"></i>
            <h2 class="fw-bold">Selesaikan Pembayaran Anda</h2>
            <p class="lead text-muted">Satu langkah lagi untuk mengamankan tiket Anda. Klik tombol di bawah untuk memilih metode pembayaran.</p>
            <hr>
            <table class="table table-bordered my-4">
                <tr>
                    <th>Nomor Tiket</th>
                    <td>{{ $pemesanan->nomor_tiket }}</td>
                </tr>
                <tr>
                    <th>Nama Penumpang</th>
                    <td>{{ $pemesanan->nama_penumpang }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Total Pembayaran</th>
                    <td class="bg-light fw-bold fs-5 text-primary">Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                </tr>
            </table>

            <button id="pay-button" class="btn btn-success btn-lg fw-bold px-5">BAYAR SEKARANG</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Skrip untuk Midtrans Snap --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            
            onSuccess: function(result){
                /* Pembayaran sukses! Lakukan "akalan" di sini. */
                console.log(result);
                // Tampilkan alert bahwa pembayaran sedang diproses
                alert('Pembayaran testing berhasil! Mengupdate status...');
                
                // Panggil route baru kita menggunakan AJAX (jQuery)
                $.ajax({
                    url: "{{ route('pemesanan.updateStatusClient') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}', // Kirim token CSRF untuk keamanan
                        order_id: result.order_id // Kirim nomor tiket dari hasil Midtrans
                    },
                    success: function (response) {
                        // Jika server merespons sukses, arahkan ke halaman riwayat
                        console.log(response.message);
                        window.location.href = "{{ route('pemesanan.index') }}";
                    },
                    error: function (error) {
                        // Jika ada error saat mengupdate status
                        console.error(error);
                        alert('Terjadi kesalahan saat mengupdate status. Silakan cek riwayat transaksi Anda atau hubungi admin.');
                    }
                });
            },

            onPending: function(result){
                alert("Menunggu pembayaran Anda!"); console.log(result);
            },
            
            onError: function(result){
                alert("Pembayaran gagal!"); console.log(result);
            }
        });
    };
</script>
@endpush
