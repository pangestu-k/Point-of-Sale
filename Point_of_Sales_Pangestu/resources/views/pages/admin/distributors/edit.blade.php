@extends('layouts.layout',['level' => 'ADMIN'])

@section('content')
    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <main>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form action="{{ route('distributor.update', $distributor->kd_distributor) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                @csrf
    
                                <div class="form-group">
                                    <label class="font-weight-bold">NAMA DISTRIBUTOR</label>
                                    <input type="text" class="form-control @error('nama_distributor') is-invalid @enderror" name="nama_distributor" value="{{ old('nama_distributor',$distributor->nama_distributor) }}" placeholder="Masukkan Nama Distributor" required>
                                
                                    <!-- error message untuk nama_distributor -->
                                    @error('nama_distributor')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">NO TELP</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp',$distributor->no_telp) }}" placeholder="Masukkan No Telpon Distributor" required>
                                
                                    <!-- error message untuk no_telp -->
                                    @error('no_telp')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
    
                                <div class="form-group">
                                    <label class="font-weight-bold">ALAMAT</label>
                                    <textarea class="form-control @error('alamt') is-invalid @enderror" name="alamat" rows="5" placeholder="Masukkan Alamat Distributor">{{ old('alamat',$distributor->alamat) }}</textarea>
                                
                                    <!-- error message untuk alamat -->
                                    @error('alamat')
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