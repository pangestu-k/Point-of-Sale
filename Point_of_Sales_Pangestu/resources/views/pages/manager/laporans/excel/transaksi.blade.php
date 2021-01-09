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
                <tr style="border-bottom:none;">
                    <th scope="col">No</th>
                    <th scope="col">Transaksi</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Kembalian</th>
                    <th scope="col">Tanggal Beli</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td>{{$no}}</td>
                        <td>Transaksi <small>{{ $transaksi->kd_transaksi }}</small></td>
                        <td><i>{{$transaksi->total_barang}}</i></td>
                        <td><b>Rp.</b> {{number_format($transaksi->total_harga)}},00</td>
                        <td><b>Rp.</b> {{number_format($transaksi->kembalian)}},00</td>
                        <td>{{date('d F Y',strtotime($transaksi->tanggal_beli))}}</td>
                    </tr>

                    @php
                        $no++;
                    @endphp
                @endforeach
                </tbody>
        </table> 
    </body>
    
</html>