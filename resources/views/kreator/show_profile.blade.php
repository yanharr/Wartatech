@extends('../layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{ session('success') }}
                </div>                                                            
            @endif  
            <div class="card">                                
                <div class="card-body">        
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-3">
                            @if($data->google_id != NULL)
                                <img src="{{ $data->foto_profile }}" class="img-fluid" width="100%" alt="">
                            @else
                                <img src="{{ asset('image/profile/'.$data->foto_profile) }}" class="img-fluid" alt="">
                            @endif
                        </div>
                        <div class="col-12 col-md-12 col-lg-9">
                            <form action="{{ url('/kreator/profile/update/'.$data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-1">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" readonly>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label for="">Alamat Email</label>
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}" readonly>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-Laki" {{ ($data->jenis_kelamin=="Laki-Laki")? "checked" : "" }} >
                                        <label class="form-check-label">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" {{ ($data->jenis_kelamin=="Perempuan")? "checked" : "" }}>
                                        <label class="form-check-label">Perempuan</label>
                                    </div>
                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-sm @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ $data->tgl_lahir }}">
                                    @error('tgl_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" class="form-control form-control-sm @error('alamat') is-invalid @enderror" cols="5" rows="2" style="resize:none;">{{ $data->alamat }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label for="">Nomor Hp</label>
                                    <input type="number" class="form-control form-control-sm @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $data->no_hp }}" min="0">
                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if(Auth::user()->google_id == NULL)
                                <div class="form-group mb-1">                                    
                                    <label for="">Foto Profile</label>
                                    <input type="file" class="form-control form-control-sm @error('foto_profile_new') is-invalid @enderror" name="foto_profile_new">
                                    <input type="text" value="{{ $data->foto_profile }}" name="foto_profile" hidden>
                                    @error('foto_profile_new')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                    
                                </div>                             
                                @else
                                @endif   
                                <button class="btn btn-sm btn-info mt-1" type="submit">Simpan</button>
                                @if($data->google_id == NULL)
                                    <a href="{{ url('/kreator/profile/edit-password/'.$data->id) }}" class="btn btn-sm btn-warning mt-1">Ubah Password</a>
                                @else
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection