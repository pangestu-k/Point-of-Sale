@extends('layouts.layout',['level' => 'MANAGER'])

@section('content')
    <div id="layoutSidenav_content">
        <div class="container-fluid">
             <main>  
            <div class="row">
                <div class="col-md-12 mb-3 mt-3">
                    <h1>Laporan</h1>
                </div>
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded" style="padding:20px;">
                        <div class="card-body" style="overflow: auto">
                            <h4 style="color: lightgray;display:inline-block;"><i>Transaksi</i></h4>

                            <a href="{{route('excelTransaks')}}" class="btn btn-success ml-2 mb-2">Print Excel</a>

                            <button type="button" class="btn btn-outline-primary ml-2 mb-2" data-toggle="modal" data-target="#staticBackdrop">
                                Laporan
                            </button>

                            <table class="table table-hover">
                                <thead>
                                <tr style="border-bottom:none;">
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Transaksi</th>
                                    <th scope="col">Total Barang yang Dibeli</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Kembalian</th>
                                    <th scope="col">Tanggal Beli</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                @forelse ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>Transaksi <small>{{ $transaksi->kd_transaksi }}</small></td>
                                        <td><i>{{$transaksi->total_barang}}</i></td>
                                        <td><b>Rp.</b> {{number_format($transaksi->total_harga)}},00</td>
                                        <td><b>Rp.</b> {{number_format($transaksi->kembalian)}},00</td>
                                        <td>{{date('d F Y',strtotime($transaksi->tanggal_beli))}}</td>
                                        <td><a class="btn btn-outline-dark" href="{{route('laporan.show',$transaksi->kd_transaksi)}}"><i>Detail</i></a></td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @empty
                                    <div class="alert alert-danger">
                                        Data Transaksi belum Tersedia.
                                    </div>
                                @endforelse
                                </tbody>
                            </table>  
                            {{ $transaksis->links() }}
                        </div>
                    </div>
                </div>      
             </div>

             <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded" style="padding:20px;">
                        <div class="card-body" style="overflow: auto">
                            <h4 style="color: lightgray;display:inline-block;"><i>Barang</i></h4>


                            <a href="{{route('excelBarangs')}}" class="btn btn-success ml-2 mb-2">Print Excel</a>

                            <button type="button" class="btn btn-outline-primary ml-2 mb-2" data-toggle="modal" data-target="#uy">
                                Laporan
                            </button>

                        <table class="table table-hover display">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">MEREK</th>
                                <th scope="col">DISTRIBUTOR</th>
                                <th scope="col">TANGGAL MASUK</th>
                                <th scope="col">HARGA BARANG</th>
                                <th scope="col">STOK BARANG</th>
                                <th scope="col">WAKTU MASUK</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                            @forelse ($barangs as $barang)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td><i>{{ $barang->merek->merek }}</i></td>
                                    <td>{{ $barang->distributor->nama_distributor }}</td>
                                    <td>{{ date('d F Y',strtotime($barang->tanggal_masuk)) }}</td>
                                    <td><b>Rp.</b> {{ number_format($barang->harga_barang) }},00</td>
                                    <td>{{ $barang->stok_barang }}</td>
                                    <td><small>{{$barang->created_at->diffForHumans()}}</small></td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @empty
                                <div class="alert alert-danger">
                                    Data Barang belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                        </table>  
                        {{ $barangs->links() }}
                    </div>
                </div>
             </div>
            </div>
        </main>
        
        </div>
       
    </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Filter Tanggal Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('tala')}}" method="GET">
                    <div class="form-group">

                        <label class="font-weight-bold">Dari</label>
                        <input type="date" class="form-control @error('dari') is-invalid @enderror" name="dari" value="{{ old('dari') }}" placeholder="Masukkan Nama dari" required>
                    
                        <!-- error message untuk nama_dari -->
                        @error('dari')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label class="font-weight-bold">Sampai</label>
                        <input type="date" class="form-control @error('sampai') is-invalid @enderror" name="sampai" value="{{ old('sampai') }}" placeholder="Masukkan Nama sampai" required>
                    
                        <!-- error message untuk nama_sampai -->
                        @error('sampai')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    </div>
                    <center><button type="submit" class="btn btn-primary col-6 m-4">Cetak Laporan <i class="fas fa-print"></i></button></center>
                  </form>
                </div>
            </div>
            </div>
        </div>

         <!-- Modal -->
         <div class="modal fade" id="uy" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="uyLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="uyLabel">Filter Tanggal Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('bala')}}" method="GET">
                    <div class="form-group">

                        <label class="font-weight-bold">Dari</label>
                        <input type="date" class="form-control @error('dari') is-invalid @enderror" name="dari" value="{{ old('dari') }}" placeholder="Masukkan Nama dari" required>
                    
                        <!-- error message untuk nama_dari -->
                        @error('dari')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label class="font-weight-bold">Sampai</label>
                        <input type="date" class="form-control @error('sampai') is-invalid @enderror" name="sampai" value="{{ old('sampai') }}" placeholder="Masukkan Nama sampai" required>
                    
                        <!-- error message untuk nama_sampai -->
                        @error('sampai')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    </div>
                    <center><button type="submit" class="btn btn-primary col-6 m-4">Cetak Laporan <i class="fas fa-print"></i></button></center>
                  </form>
                </div>
            </div>
            </div>
        </div>


@endsection