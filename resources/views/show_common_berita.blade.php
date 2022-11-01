@extends('layouts.template')

@section('title', 'Show Berita')

@section('content')
<div class="container">    
    <div class="row mt-3">
        <div class="col-12 col-md-12 col-lg-9">            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{ session('success') }}
                </div>                                                            
            @endif    
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5><i class="icon fas fa-check"></i> Gagal!</h5>
                    {{ session('error') }}
                </div>                                                            
            @endif                
            <div class="card">                                
                <div class="card-body">    
                    <div class="mb-3">
                        <h2>{{ $data->judul }}</h2>
                        <div class="card-text mb-1"style="font-size:15px;">
                            @if($data->nama_kategori == "News")
                                <span class="badge bg-primary">{{ $data->nama_kategori }}</span>
                            @elseif($data->nama_kategori == "Tips & Trick")
                                <span class="badge bg-success">{{ $data->nama_kategori }}</span>
                            @elseif($data->nama_kategori == "Tech & Life")
                                <span class="badge" style="background-color:#e0d724;">{{ $data->nama_kategori }}</span>
                            @elseif($data->nama_kategori == "Games")
                                <span class="badge" style="background-color:#aa22bf;">{{ $data->nama_kategori }}</span>
                            @endif
                        </div>                        
                    </div>    
                    @if($data->google_id == NULL)             
                    <img src="{{ asset('image/profile/'.$data->foto_profile) }}" alt="" width="40" height="40" class="rounded-circle me-1"><small class="text-muted"> {{ $data->name }} <b>&nbsp.&nbsp</b> {{ Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y')}} <b>&nbsp.&nbsp</b> {{ $data->viewer }} Pembaca</small></p>
                    @else
                    <img src="{{ $data->foto_profile }}" alt="" width="40" height="40" class="rounded-circle me-1"><small class="text-muted"> {{ $data->name }} <b>&nbsp.&nbsp</b> {{ Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y')}} <b>&nbsp.&nbsp</b> {{ $data->viewer }} Pembaca</small></p>
                    @endif
                    <img src="{{ asset('image/cover/'.$data->cover) }}" class="card-img-top rounded" style="max-height:420px;">                                                          
                    <div align="justify" class="card-text" style="font-size:15px;">  
                        {!! $data->deskripsi !!}
                    </div>      
                    <div style="font-size:12px;"><i class="far fa-heart"></i> {{ $count_like }} Disukai</div>
                    @guest   
                    @else                  
                    <div class="d-grid gap-2 d-md-block">
                        <div class="row g-0">
                            <div class="col-2 col-lg-1"> 
                                <form action="{{ url('/berita/like') }}" method="post" class="mt-3">
                                @csrf
                                    <input type="text" name="id_users" value="{{ Auth::user()->id }}" hidden>                                
                                    <input type="text" name="id_berita" value="{{ $data->id_berita }}" hidden>
                                    <button class="btn btn-info btn-sm" style="font-size:12px;" type="submit"><i class="far fa-thumbs-up"></i> Suka</button>
                                </form>   
                            </div>        
                            <div class="col-3 col-lg-2">
                                <form action="{{ url('/berita/dislike/'.$data->slug) }}" method="post" class="mt-3">
                                @csrf
                                    <input type="text" name="id_users" value="{{ Auth::user()->id }}" hidden>                                
                                    <input type="text" name="id_berita" value="{{ $data->id_berita }}" hidden>
                                    <button class="btn btn-info btn-sm" style="font-size:12px;" type="submit"><i class="far fa-thumbs-down"></i> Tidak suka</button>
                                </form> 
                            </div>                                                 
                        </div>                                                                    
                    </div> 
                    @endguest             
                </div>
            </div>            
            <div class="card mt-2">
                <div class="card-body">
                    @if (Route::has('login'))                    
                        @auth
                        <form action="{{ route('berita.komentar') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="" style="font-size:14px;">Komentar</label>
                                <input type="text" name="id_users" value="{{ Auth::user()->id }}" hidden> 
                                <input type="text" name="id_berita" value="{{ $data->id_berita }}" hidden> 
                                <textarea name="deskripsi_komentar" class="form-control form-control-sm @error('deskripsi_komentar') is-invalid @enderror" cols="3" rows="3" style="resize:none;">{{ old('deskripsi_komentar') }}</textarea>
                                @error('deskripsi_komentar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                         
                                <button type="submit" class="btn btn-sm btn-info mt-2" style="font-size:12px;">Kirim</button>                                                                
                            </div>
                        </form>
                        @else                        
                        <div class="text-center fw-bold" style="font-size:13px;">                                
                            Silahkan Login terlebih dahulu, sebelum berkomentar! <a href="{{ url('/login') }}" class="text-decoration-none"><small>Login Disini</small></a>
                        </div>                        
                        @endauth                    
                    @endif                    
                </div>
            </div>    
            <div class="card mt-2 mb-3">
                <div class="card-body">
                    <div class="fw-bold" style="font-size:14px;">                    
                        {{ $count_komentar }} Komentar
                    </div>
                    <div class="mt-3">
                        @foreach($komentar as $komentars)
                        <div class="d-flex flex-start mt-2">
                            @if($komentars->google_id == NULL)
                            <img
                                class="rounded-circle shadow-1-strong me-3"
                                src="{{ asset('image/profile/'.$komentars->foto_profile) }}"
                                alt="avatar"
                                width="55"
                                height="55"
                            />
                            @else
                            <img
                                class="rounded-circle shadow-1-strong me-3"
                                src="{{ $komentars->foto_profile }}"
                                alt="avatar"
                                width="55"
                                height="55"
                            />  
                            @endif
                            <div class="flex-grow-1 flex-shrink-1">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-1" style="font-size:14px;">
                                            {{ $komentars->name }} <span class="small text-muted">-  {{ Carbon\Carbon::parse($komentars->created_at)->diffForHumans()}}</span>
                                        </p>                                        
                                    </div>
                                    <p align="justify" class="small mb-0" style="font-size:13px;">
                                        {{ $komentars->deskripsi_komentar }}
                                    </p>
                                </div>                                
                            </div>
                        </div>  
                        @endforeach     
                    </div>
                </div>
            </div>    
        </div>
        <div class="col-12 col-md-12 col-lg-3"> 
            <div class="card" style="background-color:rgb(255,255,255);">                  
                <div class="card-body">
                    <div class="row justify-content-center">    
                        <div class="col-5 col-lg-8 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                            <h5>Berita Lainnya</h5>                        
                        </div>
                    </div>
                    @foreach($berita_lainnya as $berita_lainnyas)
                    <div class="row g-0 mb-3">
                        <div class="col-4">
                            <img src="{{ asset('image/cover/'.$berita_lainnyas->cover) }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-8">
                            <div class="align-items-start ms-2">
                                <h4 class="mb-1" style="font-size:14px;"><a href="{{ url('/berita/'.$berita_lainnyas->slug.'/'.Crypt::encrypt($berita_lainnyas->tipe_berita)) }}" class="text-decoration-none">{{ $berita_lainnyas->judul }}</a></h4>
                                <p class="mb-1" style="font-size:12px;">
                                    @if($berita_lainnyas->nama_kategori == "News")
                                    <span class="badge bg-primary">{{ $berita_lainnyas->nama_kategori }}</span>
                                    @elseif($berita_lainnyas->nama_kategori == "Tips & Trick")
                                    <span class="badge bg-success">{{ $berita_lainnyas->nama_kategori }}</span>
                                    @elseif($berita_lainnyas->nama_kategori == "Tech & Life")
                                    <span class="badge" style="background-color:#e0d724;">{{ $berita_lainnyas->nama_kategori }}</span>
                                    @elseif($berita_lainnyas->nama_kategori == "Games")
                                    <span class="badge" style="background-color:#aa22bf;">{{ $berita_lainnyas->nama_kategori }}</span>
                                    @endif 
                                </p>                                                        
                            </div>
                        </div>
                    </div>
                    @endforeach                                                                                                     
                </div>                                                
            </div>
        </div>
    </div>
</div>
@endsection



