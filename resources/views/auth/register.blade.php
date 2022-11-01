@extends('layouts.auth_layout')

@section('title', 'Register')

@section('content')
<div class="container"> 
    <div class="row align-items-center" >
        <div class="col-12 col-md-12 col-lg-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('/') }}"><img src="{{ asset('image/logo/LOGO WartaTech.png') }}" class="img-fluid" width="100%" alt=""></a>
            </div>            
        </div>
        <div class="col-12 col-md-12 col-lg-8 mh-100" style="border-left:2px solid #788BFF; height:577px; border-radius: 20px;"><br>
            <h3 class="fs-4 text-center">Buat Akun</h3>
            <div class="mt-2 text-center">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('google.login') }}" style="font-size:12px;"><i class="fab fa-google"></i>&nbsp Daftar dengan Google</a>
            </div>
            <h6 class="mt-2 text-center" style="font-size:12px;">Atau</h6>
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-6" >
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h6 style="font-size:12px;"><i class="icon fas fa-times"></i> Gagal!</h6>
                        <div style="font-size:11px;">{{ session('error') }}</div>
                    </div>                                                            
                    @endif 
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-floating mb-2" style="font-size:13px;">
                            <input type="text" style="border-bottom:2px solid #788BFF" name="name" required autocomplete="name" class="form-control form-control-sm border-top-0 border-end-0 border-start-0 @error('name') is-invalid @enderror" id="floatingName" placeholder="Nama Lengkap Anda" value="{{ old('name') }}" autofocus>
                            <label for="floatingName">Nama Lengkap</label>     
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size:8px;">{{ $message }}</strong>
                                </span>
                            @enderror                       
                        </div>
                        <div class="form-floating mb-2" style="font-size:13px;">
                            <input type="email" style="border-bottom:2px solid #788BFF" name="email" required autocomplete="email" class="form-control form-control-sm  border-top-0 border-end-0 border-start-0 @error('email') is-invalid @enderror" id="floatingEmail" placeholder="Alamat Email Anda"  value="{{ old('email') }}">
                            <label for="floatingEmail">Alamat Email</label>  
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size:8px;">{{ $message }}</strong>
                                </span>
                            @enderror                          
                        </div>
                        <div class="form-floating mb-2" style="font-size:13px;"> 
                            <input type="password" style="border-bottom:2px solid #788BFF" name="password" required autocomplete="new-password" class="form-control form-control-sm border-top-0 border-end-0 border-start-0 @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password Anda">
                            <label for="floatingPassword">Password</label>      
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="font-size:8px;">{{ $message }}</strong>
                                </span>
                            @enderror                      
                        </div>
                        <div class="form-floating mb-2" style="font-size:13px;"> 
                            <input type="password" style="border-bottom:2px solid #788BFF" name="password_confirmation" required autocomplete="new-password" class="form-control form-control-sm border-top-0 border-end-0 border-start-0 @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password Anda">
                            <label for="floatingPassword">Konfirmasi Password</label>                                                       
                        </div>
                        <div class="form-group mb-3" style="font-size:13px;">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <div style="color:red; font-size:8px;">{{ $errors->first('g-recaptcha-response') }}</div>
                                </span>
                            @endif
                        </div>
                        <div class="d-grid gap-2 col-7 mx-auto">
                            <button class="btn btn-sm btn-info" type="submit">Buat Akun</button>
                            <div style="font-size:11px;" class="text-center ">
                                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <div style="color:red;">{{ $errors->first('g-recaptcha-response') }}</div>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
