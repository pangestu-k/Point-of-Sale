<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laporan</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            .utama{
                margin:0 auto;
                border:thin solid #000;
                width:700px;
            }
            .print{
                margin:0 auto;
                width:700px;
            }
            a{
                text-decoration: none;

            }
        </style>
    </head>

    <body onload="document.getElementById('print').style.display='none';window.print();">
        <div class="print mb-3">
            <a href="#">
                <img src="{{url('admin/src/assets/img/print-icon.png')}}" id="print" width="25" height="25" border="0" /></a>
        </div>

        <div class="utama">
            <div class="container" style="padding: 20px">
                <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:10px;">
                    <tr>
                        <td width="7%" rowspan="3" align="center" valign="top">
                            <img src="{{url('landing/assets/images/logo.png')}}" width="55" height="55" class="mr-3" /></td>
                        <td width="93%" valign="top"><strong style="color:royalblue;">Point of Sales </strong></td>
                    </tr>
                    <tr>
                        <td valign="top">The Best Post Application </td>
                    </tr>
                    <tr>
                        <td valign="top">Cepat, Efektif, User Friendly </td>
                    </tr>
                </table>
    
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
            </div>
            
        </div>
        <center><p>&copy; <?php echo date('Y'); ?> SMK WIKRAMA 1 GARUT</p></center>
    </body>
    
</html>