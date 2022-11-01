@extends('layouts.auth_layout')

@section('title', 'Login')

@section('content')
<div class="container"> 
    <div class="row align-items-center" >
        <div class="col-12 col-md-12 col-lg-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('/') }}"><img src="{{ asset('image/logo/LOGO WartaTech.png') }}" class="img-fluid" width="100%" alt=""></a>
            </div>            
        </div>
        <div class="col-12 col-md-12 col-lg-8 mh-100" style="border-left:2px solid #788BFF; height:577px; border-radius: 20px;"><br>
            <h3 class="mt-5 fs-4 text-center">Masuk Akun</h3>
            <div class="mt-4 text-center">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('google.login') }}" style="font-size:12px;"><i class="fab fa-google"></i>&nbsp Masuk dengan Google</a>
            </div>
            <h6 class="mt-4 text-center" style="font-size:12px;">Atau</h6>
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-6 mt-4" >
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h6 style="font-size:12px;"><i class="icon fas fa-times"></i> Gagal!</h6>
                        <div style="font-size:11px;">{{ session('error') }}</div>
                    </div>                                                            
                    @endif 
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-floating mb-3" style="font-size:13px;">
                            <input type="email" style="border-bottom:2px solid #788BFF" name="email" required autocomplete="email" class="form-control form-control-sm border-top-0 border-end-0 border-start-0" id="floatingEmail" placeholder="Alamat Email Anda" autofocus>
                            <label for="floatingEmail">Alamat Email</label>                            
                        </div>
                        <div class="form-floating mb-3" style="font-size:13px;">
                            <input type="password" style="border-bottom:2px solid #788BFF" name="password" autocomplete="current-password" class="form-control form-control-sm border-top-0 border-end-0 border-start-0" id="floatingPassword" placeholder="Password Anda">
                            <label for="floatingPassword">Password</label>                            
                        </div>
                        <div class="d-grid gap-2 col-7 mx-auto mt-5 mb-2">
                            <button class="btn btn-sm btn-info" type="submit">Masuk</button>
                            <div style="font-size:11px;" class="text-center ">
                                Belum punya akun? <a href="{{ route('register') }}">Buat Akun</a>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
