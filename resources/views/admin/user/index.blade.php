@extends('pages.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">User</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-8 align-self-center">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm align-self-center">Tambah User</a>
                </div>
            </div>
            <!-- Table with outer spacing -->
            <div class="table-responsive">         
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIP</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>JENIS KELAMIN</th>
                                <th>ROLE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($users as $usr)
                                <tr>
                                    <td scope="row" style="vertical-align: middle;">{{$x}}</td>
                                    <td class="text-bold-500">{{ $usr->nip }}</td>
                                    <td class="text-bold-500">{{ $usr->name }}</td>
                                    <td class="text-bold-500">{{ $usr->email }}</td>
                                    <td class="text-bold-500">{{ $usr->jenis_kelamin }}</td>
                                    <td class="text-bold-500">{{ $usr->role }}</td>
                                    <td class="text-bold-500">
                                        <form action="{{ route('users.destroy', $usr->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('users.edit', $usr->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
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