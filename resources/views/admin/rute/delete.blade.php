@extends('admin.layouts.app')
@section('title', 'Konfirmasi Hapus Rute')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Hapus Rute</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4 border-left-danger">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peringatan</h6>
                </div>
                <div class="card-body">
                    <p>Apakah Anda benar-benar yakin ingin menghapus rute ini?</p>
                    <ul>
                        <li><strong>Rute Asal:</strong> {{ $rute->asal }}</li>
                        <li><strong>Rute Tujuan:</strong> {{ $rute->tujuan }}</li>
                    </ul>
                    <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>

                    <hr>

                    <form action="{{ route('admin.rute.destroy', $rute->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <a href="{{ route('admin.rute.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-danger">
                            Ya, Hapus Rute Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection