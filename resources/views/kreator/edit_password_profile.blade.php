@extends('../layouts.app')

@section('title', 'Edit Password')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-4">
        <div class="col-12">         
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5><i class="icon fas fa-times"></i> Gagal!</h5>
                    {{ session('error') }}
                </div>                                                            
            @endif   
            <div class="card">                                
                <div class="card-body">        
                    <div class="row">                        
                        <div class="col-12 col-md-12 col-lg-12">
                            <form action="{{ url('/kreator/profile/update-password/'.$data->id) }}" method="post" >
                                @csrf
                                <div class="form-group mb-1">
                                    <label for="">Password Lama</label>
                                    <input type="password" class="form-control form-control-sm @error('password_lama') is-invalid @enderror" name="password_lama">
                                    @error('password_lama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label for="">Password Baru</label>
                                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                
                                <div class="form-group mb-1">
                                    <label for="">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control form-control-sm" name="password_confirmation">                                    
                                </div>                                                                                                                             
                                <button class="btn btn-sm btn-info mt-1" type="submit">Ubah</button>     
                                <a href="{{ route('kreator.profile.show') }}" class="btn btn-sm btn-danger mt-1">Kembali</a>                           
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection