@extends('layouts.layout',['level' => 'ADMIN'])

@section('content')

    <div id="layoutSidenav_content">
    <div class="container-fluid">
        <main>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">

                            <!-- Button trigger untuk modal barang -->
                            <button type="button" class="btn btn-md btn-outline-success mb-3 mt-4" data-toggle="modal" data-target="#staticBackdrop">
                                Tambah Data Barang  <i class="fas fa-plus-circle"></i>
                              </button>

                            <table class="table  table-borderless table-hover" id="table_id">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">MEREK</th>
                                    <th scope="col">DISTRIBUTOR</th>
                                    <th scope="col">TANGGAL MASUK</th>
                                    <th scope="col">HARGA BELI</th>
                                    <th scope="col">HARGA BARANG</th>
                                    <th scope="col">STOK BARANG</th>
                                    {{-- <th scope="col">WAKSU MASUK</th> --}}
                                    <th scope="col" class="text-center">AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                @forelse ($barangs as $barang)
                                    <tr>
                                        <td class="text-center">{{$no}}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td><i>{{ $barang->merek->merek }}</i></td>
                                        <td>{{ $barang->distributor->nama_distributor }}</td>
                                        <td>{{ date('d F Y',strtotime($barang->tanggal_masuk)) }}</td>
                                        <td><b>Rp.</b> {{ number_format($barang->harga_beli) }},00</td>
                                        <td><b>Rp.</b> {{ number_format($barang->harga_barang) }},00</td>
                                        <td>{{ $barang->stok_barang }}</td>
                                        {{-- <td><small>{{$barang->created_at->diffForHumans()}}</small></td> --}}
    
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $barang->kd_barang) }}" method="POST">
                                                <a href="{{ route('barang.edit', $barang->kd_barang) }}" class="btn btn-sm btn-primary m-2"><i class="fas fa-pencil-alt"></i></a>
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

        <!-- Modal Untuk Barang -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background-color: skyblue">
                  <h5 class="modal-title text-white" id="staticBackdropLabel">Tambah Data Barang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA BARANG</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Masukkan Nama Barang" required>
                            
                                <!-- error message untuk nama_barang -->
                                @error('nama_barang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            @if ($jumlahMerek == 0)
                                    <label class="font-weight-bold">KD MEREK</label>
                                    <input type="text" readonly value="Tidak Ada Merek Apapun" class="form-control mb-4">
                                @else
                                <div class="form-group">
                                    <label class="font-weight-bold">KD MEREK</label>

                                    <select name="kd_merek" class="form-control @error('kd_merek') is-invalid @enderror">
                                        @foreach ($merekSelect as $ms)
                                            <option value="{{$ms->kd_merek}}">{{$ms->merek}}</option>
                                        @endforeach
                                    </select>

                                        <!-- error message untuk kd_merek -->
                                        @error('kd_merek')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif
                            
                             
                            @if ($jumlahDistributor == 0)
                                <label class="font-weight-bold">KD DISTRIBUTOR</label>
                                <input type="text" readonly value="Tidak Ada Distributor" class="form-control mb-4">
                            @else
                                <div class="form-group">
                                    <label class="font-weight-bold">KD DISTRIBUTOR</label>

                                    <select name="kd_distributor" class="form-control @error('kd_distributor') is-invalid @enderror">
                                        @foreach ($distributorSelect as $ds)
                                            <option value="{{$ds->kd_distributor}}">{{$ds->nama_distributor}}</option>
                                        @endforeach
                                    </select>
                                
                                    <!-- error message untuk kd_distributor -->
                                    @error('kd_distributor')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> 
                            @endif
                           

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL</label>
                                <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" placeholder="Masukkan tanggal_masuk" required>
                            
                                <!-- error message untuk tanggal_masuk -->
                                @error('tanggal_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">HARGA BELI</label>
                                <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" name="harga_beli" value="{{ old('harga_beli') }}" placeholder="Masukkan No kd Distributor" required>
                            
                                <!-- error message untuk harga_beli -->
                                @error('harga_beli')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">HARGA BARANG</label>
                                <input type="number" class="form-control @error('harga_barang') is-invalid @enderror" name="harga_barang" value="{{ old('harga_barang') }}" placeholder="Masukkan No kd Distributor" required>
                            
                                <!-- error message untuk harga_barang -->
                                @error('harga_barang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">STOK BARANG</label>
                                <input type="number" class="form-control @error('stok_barang') is-invalid @enderror" name="stok_barang" value="{{ old('stok_barang') }}" placeholder="Masukkan No kd Distributor" required>
                            
                                <!-- error message untuk stok_barang -->
                                @error('stok_barang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KETERANGAN</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="5" placeholder="Masukkan keterangan Distributor" required>{{ old('keterangan') }}</textarea>
                            
                                <!-- error message untuk stok_barang -->
                                @error('keterangan') 
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror 
                            </div>

                            @if ($jumlahMerek == 0 || $jumlahDistributor == 0)
                                <a href="{{route('barang.index')}}" class="btn btn-md btn-dark">Kembali</a>
                            @else
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            @endif
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
