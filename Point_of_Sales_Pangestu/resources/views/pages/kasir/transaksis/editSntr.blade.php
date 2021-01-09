@extends('layouts.layout',['level' => 'KASIR'])

@section('content')
    <div id="layoutSidenav_content">
        <div class="container-fluid">
             <main>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto mt-auto">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form action="{{route('updateSntr',$transaksi->kd_detail_transaksi)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                @csrf
    
                                <div class="form-group">
                                    <label class="font-weight-bold">KD BARANG</label>
                                    @if ($stok == 0)
                                            <input type="text" class="form-control" value="Tidak Ada Barang Apapun" readonly>
                                        @else
                                        <select name="kd_barang" class="form-control @error('kd_barang') is-invalid @enderror"  >
                                            @foreach ($barangSelect as $bs)
                                                <option value="{{$bs->kd_barang}}" {{$bs->kd_barang == $transaksi->kd_barang ? "selected" : ""}}>{{$bs->nama_barang}} <small>(Stok:{{$bs->stok_barang +$transaksi->qty}})</small></option>
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

                                    <select name="kd_user" class="form-control @error('kd_user') is-invalid @enderror" readonly >
                                            <option value="{{Auth::user()->kd_user}}">{{Auth::user()->username}}</option>
                                    </select>
                                
                                    <!-- error message untuk kd_user -->
                                    @error('kd_user')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">JUMLAH BELI</label>
                                    <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty',$transaksi->qty) }}" placeholder="Masukkan Jumlah Beli" >
                                    
                                    {{-- ini menampilkan error stok lebih --}}
                                       @if (Session::get('stok_kurang'))
                                          <div class="alert alert-danger mt-2">
                                              {{ Session::get('stok_kurang') }}
                                          </div>
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
                                     <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                @endif
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                <a href="{{route('transaksi.index')}}" class="btn btn-md btn-dark">Batal</a>
    
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
       
    </div>
    
@endsection