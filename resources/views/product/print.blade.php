<!DOCTYPE html>
<html>
<apex:page standardController="Quote" renderAs="pdf" applyBodyTag="false">

    <head>
        <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <style type="text/css">
            table tr td,
            table tr th {
                font-size: 9pt;
            }
        </style>
        <center>
            <h5>Data Produk Jasa Rental Kamera 'TUSTEL'</h5>
            <p id="date">{{ $time }}</p>
        </center>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($products as $p)
                <tr>
                    <td>{{ $p['id_produk'] }}</td>
                    <td>{{ $p['camera'] }}</td>
                    <td>{{ $p['harga'] }}</td>
                    <td>{{ $p['jumlah'] }}</td>
                    <td>{{ $p['describe'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</apex:page>

</html>