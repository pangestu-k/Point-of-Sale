@extends('layouts.layout',['level' => 'KASIR'])

@section('content')
    <div id="layoutSidenav_content">
        <div class="container-fluid">
             <main>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form action="{{ route('transaksi.update', $transaksi->kd_transaksi) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                @csrf
    
                                <div class="form-group">

                                        <div class="col-md-6">
                                            <h1>Pembayaran</h1>
                                            <table class="table">
                                                 <tr>
                                                    <td scope="col">Kasir </td> 
                                                    <td scope="col">:</td> 
                                                    <td scope="col" colspan="2" >{{Auth::user()->username}} - san</td>
                                                </tr>

                                                @foreach ($barangBeli as $beli) 
                                                    <tr>
                                                        <td>Barang </td>
                                                        <td scope="col">:</td>
                                                        <td scope="col">{{$beli->barang->nama_barang}} {{$beli->qty}} <i>pcs</i></td>
                                                        <td scope="col" class="text-right"><b>Rp. </b>{{ number_format($beli->barang->harga_barang * $beli->qty)}},00<td>
                                                    </tr>       
                                                @endforeach
                                                     <tr>
                                                        <td>Total Barang </td>
                                                        <td scope="col">:</td>
                                                        <td scope="col" colspan="2" class="text-right">{{$jumlahQty}} <i>pcs</i></td>
                                                     </tr>  
                                                     <tr>
                                                        <td>Total Harga </td>
                                                        <td scope="col">:</td>
                                                        <td scope="col" colspan="2" class="text-right"><b>Rp.</b>{{number_format($totalHargaBarang)}},00</td>
                                                     </tr> 
                                            </table>
                                        </div>

                                    <input type="hidden" name="kd_user" value="{{Auth::user()->kd_user}}">

                                      <input type="hidden" name="total_barang" value="{{ old('total_barang',$jumlahQty) }}">

                                    <input type="hidden" name="total_harga" value="{{ old('total_harga',$totalHargaBarang) }}">
                                

                                <div class="form-group col-6">
                                    <input type="number" class="form-control @error('total_bayar') is-invalid @enderror" name="total_bayar" value="" placeholder="Masukkan Total Bayar">

                                    {{-- ini menampilkan error stok lebih --}}
                                    @if (Session::get('uang_kurang'))
                                        <div class="alert alert-danger mt-2">
                                            {{ Session::get('uang_kurang') }}
                                        </div>
                                    @endif
                                
                                    <!-- error message untuk total_bayar -->
                                    @error('total_bayar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                @if ($stok == 0)
                                    <a href="{{route('transaksi.index')}}" class="btn btn-md btn-dark ml-4 mt-3">Kembali</a>
                                    @else
                                    <button type="submit" class="btn btn-md btn-primary ml-4 mt-3">Bayar <i class="fab fab fa-paypal"></i></button>
                                @endif
                                <button type="reset" class="btn btn-md btn-warning mt-3">RESET</button>
                                <a href="{{route('transaksi.index')}}" class="btn btn-md btn-dark mt-3">Batal</a>
    
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
       
    </div>
    
@endsection