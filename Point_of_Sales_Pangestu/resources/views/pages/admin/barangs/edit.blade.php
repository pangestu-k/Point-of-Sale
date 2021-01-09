@extends('layouts.layout',['level' => 'ADMIN'])

@section('content')
    <div id="layoutSidenav_content">
        <div class="container-fluid">
           <main>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form action="{{ route('barang.update', $barang->kd_barang) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                @csrf
    
                                <div class="form-group">
                                    <label class="font-weight-bold">NAMA BARANG</label>
                                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang',$barang->nama_barang) }}" placeholder="Masukkan Nama Barang" required>
                                
                                    <!-- error message untuk nama_barang -->
                                    @error('nama_barang')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">KD MEREK</label>

                                    <select name="kd_merek" class="form-control @error('kd_merek') is-invalid @enderror" required>
                                        @foreach ($merekSelect as $ms)
                                            <option  value="{{$ms->kd_merek}}" {{$ms->kd_merek == $barang->kd_merek ? "selected" : ""}}>{{$ms->merek}}</option>
                                        @endforeach
                                    </select>
                                
                                    <!-- error message untuk kd_merek -->
                                    @error('kd_merek')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group"> 
                                    <label class="font-weight-bold">KD DISTRIBUTOR</label>
                                    
                                    <select name="kd_distributor" class="form-control @error('kd_distributor') is-invalid @enderror" required>
                                        @foreach ($distributorSelect as $ds)
                                            <option value="{{$ds->kd_distributor}}" {{$ds->kd_distributor == $barang->kd_distributor ? "selected" : ""}}>{{$ds->nama_distributor}}</option>
                                        @endforeach
                                    </select>
                                
                                    <!-- error message untuk kd_distributor -->
                                    @error('kd_distributor')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">TANGGAL</label>
                                    <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" value="{{ old('tanggal_masuk',$barang->tanggal_masuk) }}" placeholder="Masukkan Tanggal" required>
                                
                                    <!-- error message untuk tanggal_masuk -->
                                    @error('tanggal_masuk')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">HARGA BELI</label>
                                    <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" name="harga_beli" value="{{ old('harga_beli',$barang->harga_beli) }}" placeholder="Masukkan No kd Distributor" required>
                                
                                    <!-- error message untuk harga_beli -->
                                    @error('harga_beli')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">HARGA BARANG</label>
                                    <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" name="harga_barang" value="{{ old('harga_barang',$barang->harga_barang) }}" placeholder="Masukkan No kd Distributor" required>
                                
                                    <!-- error message untuk harga_barang -->
                                    @error('harga_barang')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">STOK BARANG</label>
                                    <input type="number" class="form-control @error('stok_barang',$barang->stok_barang) is-invalid @enderror" name="stok_barang" value="{{ old('stok_barang',$barang->stok_barang) }}" placeholder="Masukkan No kd Distributor" required>
                                
                                    <!-- error message untuk stok_barang -->
                                    @error('stok_barang')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
    
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
    
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </main> 
        </div>
        
    </div>
    
@endsection