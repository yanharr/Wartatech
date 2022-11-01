<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WARTATECH | @yield('title')</title>        

    <link href = "{{asset('css/auth.css')}}" rel="stylesheet">    
    <link href ="{{ asset('image/logo/tecch.png') }}" rel="shortcut icon">
        
    <script src="https://kit.fontawesome.com/f1223f01a6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>        
    <script src="{{ asset('js/scripts.js') }}"></script>     
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</head>
<body style="background-color:rgb(245,245,245);" class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm p-3 rounded" style="background-color: rgb(255,255,255);">
        <div class="container">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img src="{{ asset('image/logo/LOGO WartaTech Nav.png') }}" alt="" width="110px" class="img-fluid mb-1">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === '/' ? 'active' : '' }}"                         
                        href="{{ route('/') }}">Beranda</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'news.show' ||
                            request()->route()->getName() === 'news.search' ? 'active' : '' }}" 
                        href="{{ route('news.show') }}">News</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'tipsNtrick.show' ||
                            request()->route()->getName() === 'tipsNtrick.search' ? 'active' : '' }}" 
                        href="{{ route('tipsNtrick.show') }}">Tips & Trick</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'techNlife.show' ||
                            request()->route()->getName() === 'techNlife.search' ? 'active' : '' }}" 
                        href="{{ route('techNlife.show') }}">Tech & Life</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->route()->getName() === 'games.show' ||
                            request()->route()->getName() === 'games.search' ? 'active' : '' }}" 
                        href="{{ route('games.show') }}">Games</a>
                    </li>                   
                </ul>
                <div class="d-flex">                         
                    @if (Route::has('login')) 
                        @auth  
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->google_id == NULL)
                                <img src="{{ asset('image/profile/'.Auth::user()->foto_profile) }}" alt="" width="28" height="28" class="rounded-circle me-2"><small class="text-muted">{{ Auth::user()->name }}</small>
                                @else
                                <img src="{{ Auth::user()->foto_profile }}" alt="" width="28" height="28" class="rounded-circle me-2"><small class="text-muted">{{ Auth::user()->name }}</small>
                                @endif
                            </button>                            
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">        
                                <li>
                                    @if(Auth::user()->level == "user")
                                    <a class="dropdown-item" href="{{ route('kreator') }}">Kreator</a>
                                    @elseif(Auth::user()->level == "admin")
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">Admin</a>
                                    @endif
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form> 
                                </li>
                            </ul>
                        </div>                        
                        @else                                                                                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 mb-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-md-2 rounded-pill">
                                Masuk
                            </a>
                        </div>   
                            @if (Route::has('register'))   
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 mb-2">
                                    <a href="{{ route('register') }}" class="btn btn-info me-md-2 rounded-pill">
                                    Daftar
                                    </a>
                                </div>                                     
                            @endif 
                        @endauth
                    @endif                 
                </div>
            </div>
        </div>
    </nav>
    @yield('content')        
</body>
<footer class="text-center text-lg-start mt-auto" style="background-color:#707FDD; color:white;">    
    <div class="container p-4">        
        <div class="row">            
            <div class="col-4 col-md-4 col-lg-4 mb-4 mb-md-0">
                <h5 class="text-uppercase">Navigasi</h5>
                <a href="{{ route('/') }}" style="text-decoration:none; color:white;">Beranda</a><br>                
                <a href="{{ route('news.show') }}" style="text-decoration:none; color:white;">News</a><br>         
                <a href="{{ route('tipsNtrick.show') }}" style="text-decoration:none; color:white;">Tips & Trick</a><br>                
                <a href="{{ route('techNlife.show') }}" style="text-decoration:none; color:white;">Tech & Life</a><br>                
                <a href="{{ route('games.show') }}" style="text-decoration:none; color:white;">Games</a>                
            </div>            
            <div class="col-4 col-md-4 col-lg-4 mb-4 mb-md-0">
                <h5 class="text-uppercase">Sosial Media</h5>
                <a href="" class="btn-facebook"><i class="fab fa-facebook fs-3" ></i></a>
                <a href="" class="btn-twitter"><i class="fab fa-twitter fs-3 ps-3"></i></a>
                <a href="" class="btn-instagram"><i class="fab fa-instagram fs-3 ps-3"></i></a>
                <a href="" class="btn-linkedin"><i class="fab fa-linkedin-in fs-3 ps-3"></i></a>
                <a href="" class="btn-telegram"><i class="fab fa-telegram fs-3 ps-3"></i></a>                
            </div>            
            <div class="col-4 col-md-4 col-lg-4 mb-4 mb-md-0">
                <h5 class="text-uppercase">Sponsor Kami</h5>                                    
                <img src="{{ asset('image/logo/Logo Gojek Baru 2019 (PNG-2160p) - FileVector69.png') }}" class="img-fluid me-2 mb-2" width="100px">                                                        
                <img src="https://indonesiabutuhanakmuda.narasi.tv/logo-primary.png" class="img-fluid me-2 mb-2" width="100px">
                <img src="{{ asset('image/logo/logo Telkom.png') }}" class="img-fluid" width="150px">                     
            </div>            
        </div>        
    </div>        
    <div class="text-center p-3" style="color:white;">
        &copy; 2022 WartaTech. All Rights Reserved         
    </div>    
</footer>
</html>
