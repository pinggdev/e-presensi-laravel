@extends('pages.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Absen Guru</h4>
        <form action="/data-guru" method="POST" class="form form-horizontal">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" name="name" value="{{$username}}" placeholder="Cari Nama...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Cari</button>
                        <a href="/print-data-guru/{{$username}}" class="btn btn-primary me-1 mb-1" target="__blank">Print</a>
                    </div>
                </div>
            </div>
        </form>
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
                                <th>NAMA</th>
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
                            @if ($presence->user->role === "guru")
                                <tr>
                                    <td scope="row" style="vertical-align: middle;">{{$x}}</td>
                                    <td class="text-bold-500">{{ $presence->user->name }}</td>
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
                                </tr>
                            @endif
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection