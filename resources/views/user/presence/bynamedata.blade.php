@extends('pages.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Keterangan</h4>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="card-content">
                <div class="card-body">
                    <p>T : Terlambat</p>
                    <p>A : Alpha</p>
                    <p>H : Hadir</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card-content">
                <div class="card-body">
                    <p>TAM : Tidak Absen Masuk</p>
                    <p>TAP : Tidak Absen Pulang</p>
                    <p>P : Pulang Cepat</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card-content">
                <div class="card-body">
                    <p>TP : Terlambat dan Pulang Cepat</p>
                    <p>TAMP : Tidak Absen Masuk Pulang Cepat</p>
                    <p>TAPT : Tidak Absen Pulang dan Terlambat</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Absen Saya</h4>
        <p>{{ Auth::user()->nip }} - {{ Auth::user()->name }}</p>
        <a href="/print-data-saya" class="btn btn-primary btn-sm" target="__blank">Print</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="row">
            </div>
            <!-- Table with outer spacing -->
            <div class="table-responsive">         
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TANGGAL</th>
                                <th>PRESENSI MASUK</th>
                                <th>PRESENSI KELUAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($presences as $presence)
                                <tr>
                                    <td scope="row" style="vertical-align: middle;">{{$x}}</td>
                                    <td class="text-bold-500">{{ $presence->tanggal_presensi }}</td>
                                    <td class="text-bold-500">{{ $presence->check_in_time }} - {{ $presence->keterangan_masuk }}</td>
                                    <td class="text-bold-500">{{ $presence->check_out_time }} - {{ $presence->keterangan_pulang }}</td>
                                    {{-- <td class="text-bold-500">
                                        <form action="{{ route('users.destroy', $presence->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('users.edit', $presence->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td> --}}
                                @php
                                    $x++;
                                @endphp
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection