@extends('layouts.layout',['level' => 'KASIR'])

@section('content')

    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <main>
                <div class="row">
                    <div class="col-md-12 mb-3 mt-3">
                        <h1>Transaksi</h1>
                    </div>

                    <div class="col-md-8">
                        <div class="card border-0 shadow rounded" style="padding:20px;">
                            <div class="card-body"  style="overflow: auto">

                                <button type="button" class="btn btn-md btn-outline-success mb-3 mt-1" data-toggle="modal" data-target="#staticBackdrop">
                                    Buat Pesanan  <i class="fas fa-plus-circle"></i>
                                </button>
                              
                                <table class="table table-hover" id="table_id">
                                    <thead>
                                    <tr style="border-bottom:none;">
                                        <th scope="col">#</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Jumlah Beli</th>
                                        <th scope="col">Harga Barang</th>
                                        <th scope="col">Tanggal Beli</th>
                                        <th scope="col" style="border-left: 0px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                            @forelse ($transaksis as $transaksi)
                                                <tr>
                                                        <td><a href="{{route('editSntr',$transaksi->kd_detail_transaksi)}}" class="btn btn-primary"><i class="far fa-edit"></i></a></td>
                                                        <td>{{ $transaksi->barang->nama_barang }}</td>
                                                        <td><i>{{$transaksi->user->username}}</i></td>
                                                        <td>{{$transaksi->qty}}</td>
                                                        <td>{{$transaksi->harga}}</td>
                                                        <td>{{date('d F Y',strtotime($transaksi->tanggal_beli))}} <small>({{$transaksi->created_at->diffForHumans()}})</small></td>
                                                        <td>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroy', $transaksi->kd_detail_transaksi) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm"><i class="fas fa-times"></i></i></button>
                                                            </form>
                                                        </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-danger">
                                                    Data Transaksi belum Tersedia.
                                                </div>
                                            @endforelse
                                    </tbody>
                                </table>  
                                <table class="table table-hover mt-2">
                                    @if ($totalHargaBarang == 0)
                                        <tr style="background-color: lightcoral">
                                            <td class="text-center" colspan="6" scope="col">Belum ada Barang yang Dibeli  <i class="far fa-frown-open"></i></td>
                                        </tr>
                                    @else
                                        <tr style="background-color: lightgreen">
                                            <td class="text-center" colspan="6" scope="col">Silahkan Lakukan Pembayaran <i class="far fa-smile"></i></td>
                                        </tr> 
                                    @endif
                                   

                                    <tr>
                                        <td scope="col" colspan="2"></td>
                                        <td scope="col" colspan="2"><b>Total Harga :</b></td>
                                        <td scope="col" colspan="2"><b>Rp.</b>{{number_format($totalHargaBarang)}},00</td>
                                    </tr>
                                </table>

                                @if ($totalHargaBarang == 0)
                                    <a href="#" class="btn btn-sm mt-2 mr-auto text-white" style="background-color: grey">Belum Memesan <i class="fab fa-paypal"></i></a>
                                @else
                                    <a href="{{ route('transaksi.edit', $idTransaksi->kd_transaksi) }}" class="btn btn-sm btn-primary mt-2 mr-auto" enable="false">Bayar Pesanan <i class="fab fa-paypal"></i>   </a>
                                @endif
                                

                                {{ $transaksis->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded" style="padding:20px;">
                            <center>
                                <img src="{{url('landing/assets/images/ihi.jpg')}}" alt="" class="img-fluid" width="200px" height="200px">
                            </center>
                        </div>

                        <div class="card border-0 shadow rounded mt-4" style="padding:20px;">
                            <div class="card-header mb-2 p-2" style="background-color: powderblue;border:0px;">
                                <i class="far fa-handshake text-white"></i> <p class="font-weight-bold text-white" style="display: inline">Transaksi Sukses</p>
                            </div>
                            @php
                                $no = 1;
                            @endphp
                            <table style="border-spacing: 5px">
                                @foreach ($kasirs as $kasir)
                                    <tr>
                                        <td><b>{{$no}}.</b> Transaksi <small>{{$kasir->kd_transaksi }}</small></td>
                                        <td>| total <b>Rp.</b> {{number_format($kasir->total_harga)}},00</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroyKasir', $kasir->kd_transaksi) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="display:inline"><i class="fas fa-times"></i></i></button>
                                            </form> 
                                        </td>
                                    </tr>

                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
              </main>
        </div>


        <!-- Modal Buat Pesanan -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color:skyblue">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Buat Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="{{ route('transaksi.store') }}" method="POST">
                            
                                @csrf
                                
    
                                <div class="form-group">
                                    <label class="font-weight-bold">KD BARANG</label>

                                    @if ($stok == 0)
                                        <input type="text" readonly value="Tidak Ada Barang Apapun" class="form-control">
                                    @else
                                        <select name="kd_barang" class="form-control @error('kd_barang') is-invalid @enderror" >
                                                 @foreach ($barangSelect as $bs)
                                                 
                                                    <option value="{{$bs->kd_barang}}">{{$bs->nama_barang}} <small>(Stok:{{$bs->stok_barang}})</small></option>
                                                @endforeach
                                               
                                        </select>
                                    @endif
                                       
                                    <!-- error message untuk kd_barang -->
                                    @error('kd_barang')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">KD USER</label>

                                    <select name="kd_user" class="form-control @error('kd_user') is-invalid @enderror" readonly>
                                            <option value="{{Auth::user()->kd_user}}">{{Auth::user()->username}}</option>
                                    </select>
                                    
                                    <!-- error message untuk kd_user -->
                                    @error('kd_user')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <input type="hidden" name="kd_transaksi" value="{{$idTransaksi->kd_transaksi}}">

                                <div class="form-group">
                                    <label class="font-weight-bold">JUMLAH BELI</label>
                                    @if ($stok == 0)
                                            <input type="text" class="form-control" value="Tidak Ada Barang" readonly>
                                        @else
                                            <input type="number" id="input" class="form-control @error('jumlah_beli') is-invalid @enderror" name="qty" value="{{ old('jumlah_beli') }}" placeholder="Masukkan Jumlah Barang yg Anda Beli" required>
                                            <input type="hidden" id="stok" value="{{$stok}}">
                                    @endif

                                    {{-- ini menampilkan error stok lebih --}}
                                    @if (Session::get('stok_kurang'))
                                        <div class="alert alert-danger mt-2">
                                            {{ Session::get('stok_kurang') }}
                                        </div>
                                        <script>
                                            $(function(){
                                                $('#staticBackdrop').modal('show');
                                            });
                                        </script>
                                    @endif
                                
                                    <!-- error message untuk jumlah_beli -->
                                    @error('jumlah_beli')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                @if ($stok == 0)
                                        <a href="{{route('transaksi.index')}}" class="btn btn-md btn-dark">Kembali</a>
                                    @else
                                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                @endif
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
    
                            </form> 
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color:skyblue">
                        
                    </div>
                </div>
                </div>
            </div>
        {{-- akhir dari modal buat Pesanan --}}
    </div>

@endsection
 