@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">Edit Kegiatan</h4>
                </div>
                <div class="col text-end">
                    <a href="{{ route('presence.index') }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('presence.update', $presence->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan"
                            value="{{ old('nama_kegiatan', $presence->nama_kegiatan) }}">
                        @error('nama_kegiatan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" name="tanggal_kegiatan" id="tanggal_kegiatan"
                            value="{{ old('tanggal_kegiatan', date('Y-m-d', strtotime($presence->tgl_kegiatan))) }}">
                        @error('tanggal_kegiatan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai"
                            value="{{ old('waktu_mulai', date('H:i', strtotime($presence->tgl_kegiatan))) }}">
                        @error('waktu_mulai')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
