<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket - {{ $pemesanan->nomor_tiket }}</title>
    <style>
        @page { margin: 0px; }
        body { font-family: 'Helvetica', sans-serif; color: #333; margin: 0px; }
        .ticket-wrapper {
            width: 700px;
            margin: 30px auto;
            border: 1px solid #eee;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 15px;
            overflow: hidden;
        }
        .ticket-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            padding-left: 30px;
        }
        .header-left h1 { margin: 0; font-size: 28px; letter-spacing: 1px; }
        .header-left p { margin: 5px 0 0; font-size: 16px; opacity: 0.9; }
        
        .ticket-body { padding: 30px; }
        .info-section {
            width: 100%;
            margin-bottom: 25px;
        }
        .info-block {
            display: inline-block;
            vertical-align: top;
        }
        .info-block .label {
            display: block;
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .info-block .value {
            font-size: 18px;
            font-weight: bold;
        }
        .route-separator {
            display: inline-block;
            vertical-align: middle;
            margin: 0 20px;
        }
        
        .ticket-stripes {
            background: #f8f9fa;
            height: 10px;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .ticket-footer {
            padding: 25px;
            width: 100%;
            box-sizing: border-box; /* Penting untuk perhitungan lebar */
        }
        .qr-code { float: left; width: 120px; }
        .footer-details { margin-left: 140px; } /* Memberi ruang untuk QR code */
        .footer-details .detail-row { margin-bottom: 10px; font-size: 14px; }
        .footer-details .label { font-size: 12px; color: #888; text-transform: uppercase; display: block; }
        .footer-details .value { font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="ticket-wrapper">
        <div class="ticket-header">
            <div class="header-left">
                <h1>88 TRAVEL JAMBI</h1>
                <p>BOARDING PASS / E-TICKET</p>
            </div>
        </div>

        <div class="ticket-body">
            <div class="info-section">
                <div class="info-block" style="width: 55%;">
                    <span class="label">Nama Penumpang</span>
                    <span class="value">{{ $pemesanan->nama_penumpang }}</span>
                </div>
                <div class="info-block" style="width: 40%;">
                    <span class="label">Nomor Tiket</span>
                    <span class="value">{{ $pemesanan->nomor_tiket }}</span>
                </div>
            </div>
            <div class="info-section">
                <div class="info-block" style="width: 42%;">
                    <span class="label">Berangkat Dari</span>
                    <span class="value">{{ $pemesanan->perjalanan->rutePerjalanan->asal }}</span>
                </div>
                <div class="route-separator">
                    {{-- Menggunakan SVG untuk ikon panah yang pasti tampil --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#0d6efd" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                      <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                    </svg>
                </div>
                <div class="info-block" style="width: 42%;">
                    <span class="label">Tujuan Ke</span>
                    <span class="value">{{ $pemesanan->perjalanan->rutePerjalanan->tujuan }}</span>
                </div>
            </div>
        </div>
        
        <div class="ticket-stripes"></div>

        <div class="ticket-footer">
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
            </div>
            <div class="footer-details">
                <div class="detail-row">
                    <span class="label">TANGGAL</span>
                    <span class="value">{{ \Carbon\Carbon::parse($pemesanan->perjalanan->tanggal_berangkat)->format('d F Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">JAM BERANGKAT</span>
                    <span class="value">{{ \Carbon\Carbon::parse($pemesanan->perjalanan->jam_berangkat)->format('H:i') }} WIB</span>
                </div>
                <div class="detail-row">
                    <span class="label">ARMADA / NO. KURSI</span>
                    <span class="value">{{ $pemesanan->perjalanan->mobil->nama_mobil }} / 
                        <strong>
                        @if($pemesanan->kursiDipesan->first())
                            {{ $pemesanan->kursiDipesan->first()->nomor_kursi }}
                        @else
                            N/A
                        @endif
                        </strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
