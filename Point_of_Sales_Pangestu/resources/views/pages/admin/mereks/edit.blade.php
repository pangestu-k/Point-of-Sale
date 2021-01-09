@extends('layouts.layout',['level' => 'ADMIN'])

@section('content')
    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <main>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form action="{{ route('merek.update', $merek->kd_merek) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                @csrf
    
                                <div class="form-group">
                                    <label class="font-weight-bold">MEREK</label>
                                    <input type="text" class="form-control @error('merek') is-invalid @enderror" name="merek" value="{{ old('merek',$merek->merek) }}" placeholder="Masukkan Nama Merek" required>
                                
                                    <!-- error message untuk merek -->
                                    @error('merek')
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