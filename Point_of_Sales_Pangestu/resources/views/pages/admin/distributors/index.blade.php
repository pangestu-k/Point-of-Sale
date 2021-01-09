@extends('layouts.layout',['level' => 'ADMIN'])

@section('content')

    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <main>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow rounded">
                            <div class="card-body">
                                {{-- <a href="{{ route('distributor.create') }}" class="btn btn-md btn-success mb-3 mt-4">TAMBAH DISTRIBUTOR</a> --}}

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-md btn-outline-success mb-3 mt-4" data-toggle="modal" data-target="#staticBackdrop">
                                    Tambah Data Distributor  <i class="fas fa-plus-circle"></i>
                                </button>

                                <table class="table table-borderless table-hover" id="table_id">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Distributor</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">No Telp</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                    @forelse ($distributors as $distributor)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{ $distributor->nama_distributor }}</td>
                                            <td>{!! $distributor->alamat !!}</td>
                                            <td>{{ $distributor->no_telp }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('distributor.destroy', $distributor->kd_distributor) }}" method="POST">
                                                    <a href="{{ route('distributor.edit', $distributor->kd_distributor) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick=""><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Distributor belum Tersedia.
                                        </div>
                                    @endforelse
                                    </tbody>
                                </table>  
                                {{ $distributors->links() }}
                            </div>
                        </div>
                    </div>
                </div>
              </main>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: skyblue">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Tambah Data Distributor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ route('distributor.store') }}" method="POST">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA DISTRIBUTOR</label>
                                <input type="text" class="form-control @error('nama_distributor') is-invalid @enderror" name="nama_distributor" value="{{ old('nama_distributor') }}" placeholder="Masukkan Nama Distributor" required>
                            
                                <!-- error message untuk nama_distributor -->
                                @error('nama_distributor')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NO TELP</label>
                                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" placeholder="Masukkan No Telpon Distributor" required>
                            
                                <!-- error message untuk no_telp -->
                                @error('no_telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">ALAMAT</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="5" placeholder="Masukkan Alamat Distributor" required>{{ old('alamat') }}</textarea>
                            
                                <!-- error message untuk alamat -->
                                @error('alamat')
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
