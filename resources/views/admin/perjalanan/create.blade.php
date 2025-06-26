@extends('admin.layouts.app')
@section('title', 'Buat Penjadwalan Baru')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Penjadwalan Perjalanan</h1>
        <a href="{{ route('admin.perjalanan.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.perjalanan.store') }}" method="POST">
        @csrf
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <div class="row gx-5">
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label for="mobil_id" class="form-label fw-bold">Pilih Mobil & Supir</label>
                            <select class="form-select @error('mobil_id') is-invalid @enderror" id="mobil_id" name="mobil_id" required>
                                <option value="">Pilih...</option>
                                @foreach ($semua_mobil as $mobil)
                                    <option value="{{ $mobil->id }}" data-nopol="{{$mobil->nomor_polisi}}" data-supir="{{$mobil->nama_supir}}">
                                        {{ $mobil->nama_mobil }}
                                    </option>
                                @endforeach
                            </select>
                             @error('mobil_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Polisi</label>
                            <input type="text" class="form-control" id="nomor_polisi" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Supir</label>
                            <input type="text" class="form-control" id="nama_supir" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jam_berangkat" class="form-label fw-bold">Jam Berangkat</label>
                            <input type="time" class="form-control @error('jam_berangkat') is-invalid @enderror" id="jam_berangkat" name="jam_berangkat" required>
                             @error('jam_berangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                         <div class="mb-3">
                            <label for="rute_perjalanan_id" class="form-label fw-bold">Rute Berangkat</label>
                            <select class="form-select @error('rute_perjalanan_id') is-invalid @enderror" id="rute_perjalanan_id" name="rute_perjalanan_id" required>
                                <option value="">Pilih Rute...</option>
                                @foreach($semua_rute as $rute)
                                <option value="{{ $rute->id }}">{{ $rute->asal }} - {{ $rute->tujuan }}</option>
                                @endforeach
                            </select>
                            @error('rute_perjalanan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="border rounded p-3">
                             <label class="form-label fw-bold">Pilih Tanggal</label>
                             <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" name="tanggal_berangkat" required>
                             @error('tanggal_berangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">SAVE</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    // Fungsi untuk mengisi otomatis data mobil saat dipilih
    $('#mobil_id').on('change', function(){
        // Ambil data dari atribut 'data-*' pada option yang dipilih
        var selectedOption = $(this).find('option:selected');
        var nopol = selectedOption.data('nopol');
        var supir = selectedOption.data('supir');

        // Isi input field yang di-disable
        $('#nomor_polisi').val(nopol || '');
        $('#nama_supir').val(supir || '');
    });
});
</script>
@endpush