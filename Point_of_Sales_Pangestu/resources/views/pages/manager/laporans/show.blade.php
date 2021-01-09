@extends('layouts.layout',['level' => 'MANAGER'])

@section('content')

<div id="layoutSidenav_content">
    <div class="container-fluid">
        <main>
            <div class="row">

                <div class="col-md-12 mb-3 mt-3 ml-2">
                    <h1>Detail Transaksi</h1>
                </div>

                

                <div class="col-md-6 ml-4 card border-0 shadow rounded p-3">

                    <table class="table table-borderless table-hover">
                         <tr>
                            <td scope="col">Kasir </td> 
                            <td scope="col">:</td> 
                            <td scope="col" colspan="2" >{{Auth::user()->username}} - san</td>
                        </tr>
                        
                        @php
                            $no = 1;
                        @endphp

                        @foreach ($barangBeli as $beli) 
                            <tr>
                                <td>Barang ({{$no}}) </td>
                                <td scope="col">:</td>
                                <td scope="col">{{$beli->barang->nama_barang}} {{$beli->qty}} <i>pcs</i></td>
                                <td scope="col"><b>Rp. </b>{{ number_format($beli->barang->harga_barang * $beli->qty)}},00<td>
                            </tr>     
                            
                            @php
                                $no++;
                            @endphp
                        @endforeach
                             <tr>
                                <td>Total Barang </td>
                                <td scope="col">:</td>
                                <td scope="col" colspan="2">{{$jumlahQty}} <i>pcs</i></td>
                             </tr>  
                             <tr>
                                <td>Total Harga </td>
                                <td scope="col">:</td>
                                <td scope="col" colspan="2"><b>Rp. </b>{{number_format($totalHargaBarang)}},00</td>
                             </tr> 

                             <tr>
                                <td>Total Bayar </td>
                                <td scope="col">:</td>
                                <td scope="col" colspan="2"><b>Rp. </b>{{number_format($hargaHargaan->total_bayar)}},00</td>
                             </tr> 

                             <tr>
                                <td>Kembalian </td>
                                <td scope="col">:</td>
                                <td scope="col" colspan="2"><b>Rp. </b>{{number_format($hargaHargaan->kembalian)}},00</td>
                             </tr> 
                    </table>

                    <a href="{{route('laporan.index')}}" class="btn btn-dark pull-left col-6 ml-auto mr-auto">Back</a>
                </div>

                <div class="col-md-5">
                    <div class="card border-0 shadow rounded" style="padding:20px;">
                        <center>
                            <img src="{{url('landing/assets/images/ihi.jpg')}}" alt="" class="img-fluid" width="300px" height="300px">
                        </center>
                    </div>
                </div>

            </div>
          </main>
    </div>

    <!-- Modal Merek -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: skyblue">
            <h5 class="modal-title text-white" id="staticBackdropLabel">Tambah Data Merek</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ route('merek.store') }}" method="POST">
                    
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">MEREK</label>
                            <input type="text" class="form-control @error('merek') is-invalid @enderror" name="merek" value="{{ old('merek') }}" placeholder="Masukkan Nama Merek" required>
                        
                            <!-- error message untuk nama_merek -->
                            @error('merek')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form> 
                </div>
            </div>
            <div class="modal-footer" style="background-color: skyblue">
                    
            </div>
        </div>
        </div>
    </div>
</div>
        
@endsection