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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.esm.min.js" integrity="sha512-SaY95UIbYlNfmc6tZOtqEWMyDHpIKJwXCPfDZNvgudlFZiJjMU3XJNrSnkVCL/3b7szsoU3hDXpUz6+TdLY1ag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    @yield('javascipt-text')
</head>
<body style="background-color:rgb(245,245,245);">
    <div class="d-flex" id="wrapper"> 
        <div class="border-end" id="sidebar-wrapper" style="background-color: rgb(255,255,255);">
            <div class="sidebar-heading border-bottom" style="background-color: rgb(255,255,255);">
                <a href="{{ route('/') }}" class="list-group-item list-group-item-light text-center"><img src="{{asset('image/logo/wartatech.jpeg')}}" alt="" width="140px;" height="20px" class="img-fluid"></a>                
            </div>
            <div class="list-group list-group-flush" >
                <div class="d-flex align-items-center mt-3 mb-2">
                    <div class="flex-shrink-0 ms-3">
                        @if(Auth::user()->google_id == NULL)
                        <img src="{{ asset('image/profile/'.Auth::user()->foto_profile) }}" width="37" height="37" class="rounded-circle me-2" alt="...">
                        @else
                        <img src="{{ Auth::user()->foto_profile }}" width="37" height="37" class="rounded-circle me-2" alt="...">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <a><small class="text-muted" style="font-size: 13px;">{{ Auth::user()->name }}</small></a>
                    </div>
                </div>
            @if(Auth::user()->level == "user")
                <a class="list-group-item list-group-item-lights mt-2 fw-bold">MENU</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->is('kreator') ? 'active' : ''}}" href="{{ route('kreator') }}"><i class="fa fa-dashboard me-2"></i>Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'kreator.profile.show' || 
                    request()->route()->getName() === 'edit.password.profile' ? 'active' : ''}}"                     
                    href="{{ route('kreator.profile.show') }}"><i class="fa fa fa-user me-2"></i>Profile
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'kreator.berita' ||
                    request()->route()->getName() === 'kreator.berita.tambah' ||
                    request()->route()->getName() === 'kreator.berita.edit' ||
                    request()->route()->getName() === 'kreator.berita.search' ? 'active' : '' }}"                 
                    href="{{ route('kreator.berita') }}"><i class="fas fa-newspaper me-2"></i>Berita
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'kreator.berita.premium' || 
                    request()->route()->getName() === 'kreator.berita.premium.list' || 
                    request()->route()->getName() === 'kreator.berita.premium.beli' || 
                    request()->route()->getName() === 'kreator.berita.premium.search' ? 'active' : '' }}" 
                    href="{{ route('kreator.berita.premium') }}"><i class="fas fa-comment-dollar me-2"></i>Berita Premium
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'kreator.berita.premium.riwayat' ||
                    request()->route()->getName() === 'kreator.berita.premium.riwayat.search' ? 'active' : '' }}" 
                    href="{{ route('kreator.berita.premium.riwayat') }}"><i class="fas fa-clipboard-list me-2"></i>Riwayat Transaksi
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'kreator.wartapay' || 
                    request()->route()->getName() === 'kreator.wartapay.search' ? 'active' : '' }}" 
                    href="{{ route('kreator.wartapay') }}"><i class="fas fa-coins me-2"></i>WartaPay
                </a>
                <a class="list-group-item list-group-item-lights mt-2 fw-bold">OTHERS</a>                
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form> 
            @elseif(Auth::user()->level == "admin")
                <a class="list-group-item list-group-item-lights mt-2 fw-bold">MENU</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'admin.index' ? 'active' : ''}}" href="{{ route('admin.index') }}"><i class="fa fa-dashboard me-2"></i>Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'admin.kategori' || 
                    request()->route()->getName() === 'admin.kategori.tambah' ||
                    request()->route()->getName() === 'admin.kategori.edit' || 
                    request()->route()->getName() === 'admin.kategori.search' ? 'active' : ''}}"                     
                    href="{{ route('admin.kategori') }}"><i class="fas fa-server me-2"></i>Data Kategori
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'admin.datakreator' || 
                    request()->route()->getName() === 'admin.datakreator.search' ? 'active' : '' }}"                 
                    href="{{ route('admin.datakreator') }}"><i class="fas fa-users me-2"></i>Data Kreator
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'admin.databerita' || 
                    request()->route()->getName() === 'admin.databerita.search' ? 'active' : '' }}" 
                    href="{{ route('admin.databerita') }}"><i class="fas fa-newspaper me-2"></i>Data Berita
                </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'admin.transaksi.beritapremium' ||
                    request()->route()->getName() === 'admin.transaksi.beritapremium.search' ? 'active' : '' }}" 
                    href="{{ route('admin.transaksi.beritapremium') }}"><i class="fas fa-shopping-cart me-2"></i>Transaksi Berita Premium
                </a>                
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ request()->route()->getName() === 'admin.riwayat.transaksi.topup' ||
                    request()->route()->getName() === 'admin.riwayat.transaksi.topup.search' ? 'active' : '' }}" 
                    href="{{ route('admin.riwayat.transaksi.topup') }}"><i class="fas fa-history me-2"></i>Riwayat WartaPay
                </a>
                <a class="list-group-item list-group-item-lights mt-2 fw-bold">OTHERS</a>                
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>  
            @endif
            </div>                        
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color: rgb(255,255,255);">
                <div class="container-fluid">
                    <button class="btn btn-info" id="sidebarToggle">
                        <i class="fas fa-sliders-h"></i>
                    </button>                
                </div>
            </nav>
            <div style="font-size:14px;">
                @yield('content')
            </div>            
        </div>
    </div>         
</body>
<footer>
@yield('ck-editor')
</footer>
</html>