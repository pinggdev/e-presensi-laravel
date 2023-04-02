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
    <h2>Data Absen Bulanan {{ Auth::user()->name }}</h2>
    <p>Nama : {{ Auth::user()->name }}</p>
    <p>NIP : {{ Auth::user()->nip }}</p>
   
        <table>
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
                    <td>{{ $presence['tanggal_presensi'] }}</td>
                    <td>{{ $presence['check_in_time'] }} - {{ $presence['keterangan_masuk'] }}</td>
                    <td>{{ $presence['check_out_time'] }} - {{ $presence['keterangan_pulang'] }}</td>
                </tr>
                @php $x++; @endphp
                @endforeach

                </tr>
            </tbody>
        </table>
</div>
</body>
</html>