<!DOCTYPE html>
<html>
<apex:page standardController="Quote" renderAs="pdf" applyBodyTag="false">

    <head>
        <title>Laporan Data TUSTEL</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <style type="text/css">
            table tr td,
            table tr th {
                font-size: 9pt;
            }

            p {
                font-size: 10pt;
            }
        </style>
        <center>
            <h5>Data Retur Jasa Rental Kamera 'TUSTEL'</h5>
        </center>
        <p class="text-right">Waktu : {{ $time }} <br>Pengguna : {{auth()->user()->name}}</p>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA PELANGGAN</th>
                    <th>ID RENTAL</th>
                    <th>TANGGAL KEMBALI</th>
                    <th>DENDA</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($returs as $p)
                <tr>
                    <td>{{ $p['id_retur'] }}</td>
                    <td>{{ $p['nama'] }}</td>
                    <td>{{ $p['id_rental'] }}</td>
                    <td>{{ $p['tanggal_kembali'] }}</td>
                    <td>{{ $p['denda'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</apex:page>

</html>