<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        .text-center {
            text-align: center;
        }

        table {
            width: 100%;
            font-size: 14px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>

<body>

    <h1 class="text-center">{{ env('APP_NAME') }}</h1>

    {{-- Info kegiatan --}}
    <table style="margin-bottom: 20px; border: none;">
        <tr>
            <td style="width: 160px; font-weight: bold; border: none;">Nama Kegiatan</td>
            <td style="width: 10px; border: none;">:</td>
            <td style="border: none;">{{ $presence->nama_kegiatan }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; border: none;">Tanggal Kegiatan</td>
            <td style="border: none;">:</td>
            <td style="border: none;">{{ date('d-m-Y', strtotime($presence->tgl_kegiatan)) }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; border: none;">Waktu Mulai</td>
            <td style="border: none;">:</td>
            <td style="border: none;">{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
        </tr>
    </table>

    {{-- Tabel daftar hadir --}}
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Asal Instansi</th>
                <th>Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
@forelse ($presenceDetails as $detail)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $detail->nama }}</td>
        <td>{{ $detail->jabatan }}</td>
        <td>{{ $detail->asal_instansi }}</td>
        <td>
@if ($detail->tanda_tangan)
    @php
        $path = storage_path('app/public/tanda-tangan/' . $detail->tanda_tangan);
    @endphp

    @if (file_exists($path))
        @php
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $img }}" style="max-height: 50px; display:block; margin:auto;">
        <small style="color:blue">{{ $detail->tanda_tangan }}</small>
    @else
        <span style="color:red;">File tidak ditemukan</span>
    @endif
@else
    <span style="color:red;">Belum ada tanda tangan</span>
@endif
</td>

    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">Tidak ada data</td>
    </tr>
@endforelse
</tbody>

    </table>

</body>

</html>
