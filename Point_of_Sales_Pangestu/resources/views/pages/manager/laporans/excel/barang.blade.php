<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laporan</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>

    <body>
        <table class="table table-borderless col-8 mt-3">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Merek</th>
                <th scope="col">Distributor</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td><i>{{ $barang->merek->merek }}</i></td>
                    <td>{{ $barang->distributor->nama_distributor }}</td>
                    <td>{{ date('d F Y',strtotime($barang->tanggal_masuk)) }}</td>
                    <td><b>Rp.</b> {{ number_format($barang->harga_barang) }},00</td>
                    <td>{{ $barang->stok_barang }}</td>
                </tr>

                @php
                    $no++;
                @endphp

            @endforeach
            </tbody>
        </table> 
    </body>
    
</html>