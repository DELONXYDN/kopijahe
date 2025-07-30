@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Daftar Kegiatan</h4>
                </div>
                <div class="col text-end">
                    <a href="{{ route('presence.create' ) }}" class="btn btn-primary">
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Waktu Mulai</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($presences->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @else
                            @foreach ($presences as $presence)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $presence->nama_kegiatan }}</td>
                                    <td>{{ date('d-m-y', strtotime($presence->tgl_kegiatan)) }}</td>
                                    <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                                    <td>
                                        <a href="{{ route('presence.show', $presence->id) }}" class="btn btn-sm btn-secondary">detail</a>
                                        <a href="{{ route('presence.edit', $presence->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('presence.destroy', $presence->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
