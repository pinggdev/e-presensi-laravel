<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, td, th {
          border: 1px solid;
        }
        
        table {
          width: 100%;
          border-collapse: collapse;
        }
    </style>
</head>
<body>
    {{-- {{dd($username)}} --}}
    <h2>Data {{ $username !== '' ? $presences[0]['name'] : 'Guru' }}</h2>
   
    @if ($username !== '')
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    {{-- <th>NAMA</th> --}}
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
                    {{-- <td>{{ $presence['name'] }}</td> --}}
                    <td>{{ $presence['tanggal_presensi'] }}</td>
                    <td>{{ $presence['check_in_time'] }} - {{ $presence['keterangan_masuk'] }}</td>
                    <td>{{ $presence['check_out_time'] }} - {{ $presence['keterangan_pulang'] }}</td>
                </tr>
                @php $x++; @endphp
                @endforeach

                </tr>
            </tbody>
        </table>
    @else
        <table>
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
                <tr>
                    <td scope="row" style="vertical-align: middle;">{{$x}}</td>
                    <td>{{ $presence['name'] }}</td>
                    <td>{{ $presence['tanggal_presensi'] }}</td>
                    <td>{{ $presence['check_in_time'] }} - {{ $presence['keterangan_masuk'] }}</td>
                    <td>{{ $presence['check_out_time'] }} - {{ $presence['keterangan_pulang'] }}</td>
                </tr>
                @php $x++; @endphp
                @endforeach

                </tr>
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
