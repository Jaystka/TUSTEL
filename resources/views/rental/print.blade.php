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
            <h5>Data Sewa Jasa Rental Kamera 'TUSTEL'</h5>
        </center>
        <p class="text-right">Waktu : {{ $time }} <br>Pengguna : {{auth()->user()->name}}</p>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA PELANGGAN</th>
                    <th>PRODUK</th>
                    <th>JUMLAH</th>
                    <th>TANGGAL SEWA</th>
                    <th>DURASI</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental['id_rental'] }}</td>
                    <td>{{ $rental['nama'] }}</td>
                    <td>{{ $rental['camera'] }}</td>
                    <td>{{ $rental['jumlah'] }}</td>
                    <td>{{ $rental['created_at'] }}</td>
                    <td>{{ $rental['durasi'] == '6' ? '6 Jam' : ($rental['durasi'] == '12' ? '12
                        Jam': ($rental['durasi'] == '24' ? '1 Hari' :
                        ($rental['durasi'] == '48' ? '2 Hari' : ($rental['durasi'] == '96' ? '4 Hari' :
                        ($rental['durasi'] == '144' ? '7 Hari' : ($rental['durasi'] == '288' ? '14 Hari' : 'Kosong')) )
                        )))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</apex:page>

</html>