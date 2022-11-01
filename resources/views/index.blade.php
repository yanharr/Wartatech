@extends('layouts.template')

@section('title', 'Home Page')

@section('content')
<div class="container mt-4">    
    <div class="row">
        <div class="col-12 col-md-12 col-lg-9">
            <div class="shadow p-3 bg-body rounded" style="background-color: rgb(255, 255, 255);">
                <h4 class="display-6 fw-bold ms-3">Jadi yang terdepan menyaksikan perkembangan teknologi di Indonesia.</h4>
                <p class="lead ms-3">Insight premium, eksklusif, dan mendalam seputar dunia teknologi, startup, dan profesional dari WartaTech Indonesia.</p>
                <div class="d-grid gap-2 col-5">
                    <a class="btn btn-info rounded-pill ms-3 mb-2" href="{{ route('register') }}" >Daftar Sekarang</a>
                </div>
            </div> 
            <div class="card mb-3 mt-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="{{ asset('image/cover/'.$berita_trending_first->cover) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption" style="background-color:black; opacity:0.7; height:130px; margin-left:2px; margin-right:2px;">
                                <h5 style="font-size:15px;">{{ $berita_trending_first->judul }}</h5>
                                <div style="font-size:10px;">{!! $berita_trending_first->deskripsi_singkat !!}</div>
                            </div>
                        </div> 
                        @foreach($berita_trending as $berita_trendings)
                        <div class="carousel-item">
                            <img src="{{ asset('image/cover/'.$berita_trendings->cover) }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption" style="background-color:black; opacity:0.7; height:130px; margin-left:2px; margin-right:2px;">
                                <h5 style="font-size:15px;">{{ $berita_trendings->judul }}</h5>
                                <div style="font-size:10px;">{!! $berita_trendings->deskripsi_singkat !!}</div>
                            </div>
                        </div>  
                        @endforeach                                              
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div> 
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <div class="col-4 col-lg-2 text-center mt-2" style="border-bottom:2px solid #788BFF;">
                        <h5>Berita Terkini</h5>                                            
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 mt-4">
                        @foreach($berita_terkini as $berita_terkinis)
                        <div class="row g-0 mb-4">
                            <div class="col-4">
                                <img src="{{ asset('image/cover/'.$berita_terkinis->cover) }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-8">
                                <div class="align-items-start ms-3">
                                    <h5 class=""><a href="{{ url('/berita/'.$berita_terkinis->slug.'/'.Crypt::encrypt($berita_terkinis->tipe_berita)) }}" class="text-decoration-none">{{ $berita_terkinis->judul }}</a></h5>
                                    <div class="card-text mb-1"style="font-size:12px;">
                                        @if($berita_terkinis->nama_kategori == "News")
                                        <span class="badge bg-primary">{{ $berita_terkinis->nama_kategori }}</span>
                                        @elseif($berita_terkinis->nama_kategori == "Tips & Trick")
                                        <span class="badge bg-success">{{ $berita_terkinis->nama_kategori }}</span>
                                        @elseif($berita_terkinis->nama_kategori == "Tech & Life")
                                        <span class="badge" style="background-color:#e0d724;">{{ $berita_terkinis->nama_kategori }}</span>
                                        @elseif($berita_terkinis->nama_kategori == "Games")
                                        <span class="badge" style="background-color:#aa22bf;">{{ $berita_terkinis->nama_kategori }}</span>
                                        @endif 
                                    </div>
                                    <div class="card-text mb-2" style="font-size:13px;">
                                        {!! $berita_terkinis->deskripsi_singkat !!}
                                    </div>                                    
                                    <div class="card-text">
                                        @if($berita_terkinis->google_id == NULL)
                                        <img src="{{ asset('image/profile/'.$berita_terkinis->foto_profile) }}" class="rounded-circle" width="7%">
                                        @else
                                        <img src="{{ $berita_terkinis->foto_profile }}" class="rounded-circle" width="7%">
                                        @endif
                                        <small class="text-muted ms-1" style="font-size:12px;">{{ $berita_terkinis->name }} - {{ Carbon\Carbon::parse($berita_terkinis->created_at)->diffForHumans()}}</small>
                                    </div>
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
                            <h5>Berita Premium</h5>                        
                        </div>
                    </div>
                    @foreach($berita_premium as $berita_premiums)
                    <div class="row g-0 mb-3">
                        <div class="col-4">
                            <img src="{{ asset('image/cover/'.$berita_premiums->cover) }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-8">
                            <div class="align-items-start ms-2">
                                <h4 class="mb-1" style="font-size:14px;"><a href="{{ route('login') }}" class="text-decoration-none">{{ $berita_premiums->judul }}</a></h4>
                                <p class="mb-1" style="font-size:12px;">
                                    <span class="badge bg-danger">Premium</span>
                                    @if($berita_premiums->nama_kategori == "News")
                                    <span class="badge bg-primary">{{ $berita_premiums->nama_kategori }}</span>
                                    @elseif($berita_premiums->nama_kategori == "Tips & Trick")
                                    <span class="badge bg-success">{{ $berita_premiums->nama_kategori }}</span>
                                    @elseif($berita_premiums->nama_kategori == "Tech & Life")
                                    <span class="badge" style="background-color:#e0d724;">{{ $berita_premiums->nama_kategori }}</span>
                                    @elseif($berita_premiums->nama_kategori == "Games")
                                    <span class="badge" style="background-color:#aa22bf;">{{ $berita_premiums->nama_kategori }}</span>
                                    @endif 
                                </p>                                                        
                            </div>
                        </div>
                    </div>
                    @endforeach                                       
                </div>                                                
            </div>            
            <div class="card mt-3" style="background-color:rgb(255,255,255);">                  
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-5 col-lg-5 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                            <h5>Kategori</h5>                        
                        </div>
                    </div>                    
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">
                            @foreach($total_kategori as $total_kategoris)
                            <div class="col-9 col-lg-9">
                                <div class="mb-2 fs-6">
                                    {{ $total_kategoris->nama_kategori }}
                                </div>
                            </div>    
                            <div class="col-3 col-lg-3">
                                <div class="mb-2 fs-6">
                                    @if($total_kategoris->nama_kategori == "News")
                                    <span class="badge rounded-pill bg-primary">{{ $total_kategoris->total }}</span>
                                    @elseif($total_kategoris->nama_kategori == "Tips & Trick")
                                    <span class="badge rounded-pill bg-success">{{ $total_kategoris->total }}</span>
                                    @elseif($total_kategoris->nama_kategori == "Tech & Life")
                                    <span class="badge rounded-pill" style="background-color:#e0d724;">{{ $total_kategoris->total }}</span>
                                    @elseif($total_kategoris->nama_kategori == "Games")
                                    <span class="badge rounded-pill" style="background-color:#aa22bf;">{{ $total_kategoris->total }}</span>
                                    @endif                                     
                                </div>
                            </div>    
                            <hr style="color:#788BFF;">  
                            @endforeach                              
                        </div>                                   
                    </div>                                                                
                </div>                                                
            </div>            
        </div>          
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-2 col-lg-1 text-center mt-2" style="border-bottom:2px solid #788BFF;">
                            <h5>News</h5>                        
                        </div>                    
                        <div class="col-12 col-md-12 col-lg-12 mt-4">  
                            <div class="row">
                                @foreach($news as $newss)
                                <div class="col-12 col-md-12 col-lg-4 mb-2">
                                    <div class="card" style="height:420px; max-height:420px;">
                                        <img src="{{ asset('image/cover/'.$newss->cover) }}" class="card-img-top" style="max-height:220px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{ url('/berita/'.$newss->slug.'/'.Crypt::encrypt($newss->tipe_berita)) }}" class="text-decoration-none">{{ $newss->judul }}</a></h5>
                                            <div class="card-text mb-1"style="font-size:12px;">
                                                @if($newss->nama_kategori == "News")
                                                <span class="badge bg-primary">{{ $newss->nama_kategori }}</span>
                                                @elseif($newss->nama_kategori == "Tips & Trick")
                                                <span class="badge bg-success">{{ $newss->nama_kategori }}</span>
                                                @elseif($newss->nama_kategori == "Tech & Life")
                                                <span class="badge" style="background-color:#e0d724;">{{ $newss->nama_kategori }}</span>
                                                @elseif($newss->nama_kategori == "Games")
                                                <span class="badge" style="background-color:#aa22bf;">{{ $newss->nama_kategori }}</span>
                                                @endif                                                
                                            </div>
                                            <div class="card-text mb-1" style="font-size:13px;">{!! $newss->deskripsi_singkat !!}...</div>
                                            <div class="card-text">
                                                @if($newss->google_id == NULL)
                                                <img src="{{ asset('image/profile/'.$newss->foto_profile) }}" class="rounded-circle" width="7%">
                                                @else
                                                <img src="{{ $newss->foto_profile }}" class="rounded-circle" width="7%">
                                                @endif
                                                <small class="text-muted ms-1" style="font-size:11px;">{{ $newss->name }} - {{ Carbon\Carbon::parse($newss->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>                   
                                @endforeach                                                                                                                                            
                            </div> 
                            <a href="{{ route('news.show') }}" class="btn btn-sm btn-info">Baca Selengkapnya &nbsp<i class="fas fa-arrow-right"></i></a>  
                        </div>
                    </div>                    
                </div>
            </div> 
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-2 text-center mt-2" style="border-bottom:2px solid #788BFF;">
                            <h5>Tips & Trick</h5>                        
                        </div>                    
                        <div class="col-12 col-md-12 col-lg-12 mt-4">  
                            <div class="row">      
                            @foreach($tipsNtrick as $tipsNtricks)
                                <div class="col-12 col-md-12 col-lg-4 mb-2">
                                    <div class="card" style="height:420px; max-height:420px;">
                                        <img src="{{ asset('image/cover/'.$tipsNtricks->cover) }}" class="card-img-top" style="max-height:220px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{ url('/berita/'.$tipsNtricks->slug.'/'.Crypt::encrypt($tipsNtricks->tipe_berita)) }}" class="text-decoration-none">{{ $tipsNtricks->judul }}</a></h5>
                                            <div class="card-text mb-1"style="font-size:12px;">
                                                @if($tipsNtricks->nama_kategori == "News")
                                                <span class="badge bg-primary">{{ $tipsNtricks->nama_kategori }}</span>
                                                @elseif($tipsNtricks->nama_kategori == "Tips & Trick")
                                                <span class="badge bg-success">{{ $tipsNtricks->nama_kategori }}</span>
                                                @elseif($tipsNtricks->nama_kategori == "Tech & Life")
                                                <span class="badge" style="background-color:#e0d724;">{{ $tipsNtricks->nama_kategori }}</span>
                                                @elseif($tipsNtricks->nama_kategori == "Games")
                                                <span class="badge" style="background-color:#aa22bf;">{{ $tipsNtricks->nama_kategori }}</span>
                                                @endif                                                
                                            </div>
                                            <div class="card-text mb-1" style="font-size:13px;">{!! $tipsNtricks->deskripsi_singkat !!}...</div>
                                            <div class="card-text">
                                                @if($tipsNtricks->google_id == NULL)
                                                <img src="{{ asset('image/profile/'.$tipsNtricks->foto_profile) }}" class="rounded-circle" width="7%">
                                                @else
                                                <img src="{{ $tipsNtricks->foto_profile }}" class="rounded-circle" width="7%">
                                                @endif
                                                <small class="text-muted ms-1" style="font-size:11px;">{{ $tipsNtricks->name }} - {{ Carbon\Carbon::parse($tipsNtricks->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>                   
                            @endforeach                                                                                                                                                                                                 
                            </div> 
                            <a href="{{ route('tipsNtrick.show') }}" class="btn btn-sm btn-info">Baca Selengkapnya &nbsp<i class="fas fa-arrow-right"></i></a>  
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-2 text-center mt-2" style="border-bottom:2px solid #788BFF;">
                            <h5>Tech & Life</h5>                        
                        </div>                    
                        <div class="col-12 col-md-12 col-lg-12 mt-4">  
                            <div class="row">
                            @foreach($techNlife as $techNlifes)
                                <div class="col-12 col-md-12 col-lg-4 mb-2">
                                    <div class="card" style="height:420px; max-height:420px;">
                                        <img src="{{ asset('image/cover/'.$techNlifes->cover) }}" class="card-img-top" style="max-height:220px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{ url('/berita/'.$techNlifes->slug.'/'.Crypt::encrypt($techNlifes->tipe_berita)) }}" class="text-decoration-none">{{ $techNlifes->judul }}</a></h5>
                                            <div class="card-text mb-1"style="font-size:12px;">
                                                @if($techNlifes->nama_kategori == "News")
                                                <span class="badge bg-primary">{{ $techNlifes->nama_kategori }}</span>
                                                @elseif($techNlifes->nama_kategori == "Tips & Trick")
                                                <span class="badge bg-success">{{ $techNlifes->nama_kategori }}</span>
                                                @elseif($techNlifes->nama_kategori == "Tech & Life")
                                                <span class="badge" style="background-color:#e0d724;">{{ $techNlifes->nama_kategori }}</span>
                                                @elseif($techNlifes->nama_kategori == "Games")
                                                <span class="badge" style="background-color:#aa22bf;">{{ $techNlifes->nama_kategori }}</span>
                                                @endif                                                
                                            </div>
                                            <div class="card-text mb-1" style="font-size:13px;">{!! $techNlifes->deskripsi_singkat !!}...</div>
                                            <div class="card-text">
                                                @if($techNlifes->google_id == NULL)
                                                <img src="{{ asset('image/profile/'.$techNlifes->foto_profile) }}" class="rounded-circle" width="7%">
                                                @else
                                                <img src="{{ $techNlifes->foto_profile }}" class="rounded-circle" width="7%">
                                                @endif
                                                <small class="text-muted ms-1" style="font-size:11px;">{{ $techNlifes->name }} - {{ Carbon\Carbon::parse($techNlifes->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>                   
                            @endforeach                                                                                                                                                                                                   
                            </div> 
                            <a href="{{ route('techNlife.show') }}" class="btn btn-sm btn-info">Baca Selengkapnya &nbsp<i class="fas fa-arrow-right"></i></a>  
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-3 col-lg-1 text-center mt-2" style="border-bottom:2px solid #788BFF;">
                            <h5>Games</h5>                        
                        </div>                    
                        <div class="col-12 col-md-12 col-lg-12 mt-4">  
                            <div class="row">
                            @foreach($games as $game)
                                <div class="col-12 col-md-12 col-lg-4 mb-2">
                                    <div class="card" style="height:420px; max-height:420px;">
                                        <img src="{{ asset('image/cover/'.$game->cover) }}" class="card-img-top" style="max-height:220px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{ url('/berita/'.$game->slug.'/'.Crypt::encrypt($game->tipe_berita)) }}" class="text-decoration-none">{{ $game->judul }}</a></h5>
                                            <div class="card-text mb-1"style="font-size:12px;">
                                                @if($game->nama_kategori == "News")
                                                <span class="badge bg-primary">{{ $game->nama_kategori }}</span>
                                                @elseif($game->nama_kategori == "Tips & Trick")
                                                <span class="badge bg-success">{{ $game->nama_kategori }}</span>
                                                @elseif($game->nama_kategori == "Tech & Life")
                                                <span class="badge" style="background-color:#e0d724;">{{ $game->nama_kategori }}</span>
                                                @elseif($game->nama_kategori == "Games")
                                                <span class="badge" style="background-color:#aa22bf;">{{ $game->nama_kategori }}</span>
                                                @endif                                                
                                            </div>
                                            <div class="card-text mb-1" style="font-size:13px;">{!! $game->deskripsi_singkat !!}...</div>
                                            <div class="card-text">
                                                @if($game->google_id == NULL)
                                                <img src="{{ asset('image/profile/'.$game->foto_profile) }}" class="rounded-circle" width="7%">
                                                @else
                                                <img src="{{ $game->foto_profile }}" class="rounded-circle" width="7%">
                                                @endif
                                                <small class="text-muted ms-1" style="font-size:11px;">{{ $game->name }} - {{ Carbon\Carbon::parse($game->created_at)->diffForHumans()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>                   
                            @endforeach                                                                                                                                                                                               
                            </div> 
                            <a href="{{ route('games.show') }}" class="btn btn-sm btn-info">Baca Selengkapnya &nbsp<i class="fas fa-arrow-right"></i></a>  
                        </div>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection