@extends('layouts.layout',['level' => 'ADMIN'])

@section('content')

    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <main>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow rounded">
                            <div class="card-body">
                                {{-- <a href="{{ route('merek.create') }}" class="btn btn-md btn-success mb-3 mt-4">TAMBAH MEREK</a> --}}

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-md btn-outline-success mb-3 mt-4" data-toggle="modal" data-target="#staticBackdrop">
                                   Tambah Merek  <i class="fas fa-plus-circle"></i>
                                </button>

                                <table class="table table- table-borderless table-hover" id="table_id">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Merek</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                    @forelse ($mereks as $merek)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{ $merek->merek }}</td>
                                            <td class="text-center">
                                                
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('merek.destroy', $merek->kd_merek) }}" method="POST">
                                                    <a href="{{ route('merek.edit', $merek->kd_merek) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Merek belum Tersedia.
                                        </div>
                                    @endforelse
                                    </tbody>
                                </table>  
                                {{ $mereks->links() }}
                            </div>
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
