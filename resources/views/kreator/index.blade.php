@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">    
    <div class="row">        
        <div class="col-6 col-md-12 col-lg-3">
            <div class="card mt-4 shadow rounded" style="background: #707FDD">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 ms-2">
                            <i class="fas fa-newspaper fa-3x" style="color: white;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 mt-1">
                            <a>
                                <h2 style="font-size: 17px; color: white">
                                    <li type="none">Berita</li>
                                </h2>
                                <small style="font-size: 15px; color: white"> 
                                    <li type="none">{{ $berita }}</li>
                                </small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-12 col-lg-3">
            <div class="card mt-4 shadow rounded" style="background: #707FDD">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 ms-2">
                            <i class="fas fa-comment-dollar fa-3x" style="color: white;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 mt-1">
                            <a>
                                <h2 style="font-size: 17px; color: white">
                                    <li type="none">Berita Premium</li>
                                </h2>
                                <small style="font-size: 15px; color: white"> 
                                    <li type="none">{{ $berita_premium }}</li>
                                </small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-12 col-lg-3">
            <div class="card mt-4" style="background: #707FDD">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 ms-2">
                            <i class="fas fa-wallet fa-3x" style="color: white;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 mt-1">
                            <a>
                                <h2 style="font-size: 17px; color: white">
                                    <li type="none">Saldo</li>
                                </h2>
                                <small style="font-size: 15px; color: white"> 
                                    <li type="none">Rp. {{ number_format(Auth::user()->saldo, 0, '', '.') }}</li>
                                </small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-12 col-lg-3">
            <div class="card mt-4" style="background: #707FDD">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 ms-2">
                            <i class="fas fa-book-reader fa-3x" style="color: white;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 mt-1">
                            <a>
                                <h2 style="font-size: 17px; color: white">
                                    <li type="none">Total Pembaca</li>
                                </h2>
                                <small style="font-size: 15px; color: white"> 
                                    <li type="none">{{ $pembaca }}</li>
                                </small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><hr style="opacity:0.1;">   
    <div class="row g-2">
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="col-8 col-lg-6 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                        <h6 style="font-size:14px;">Top 5 Berita Dengan Pembaca Terbanyak</h6>                        
                    </div>                    
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold text-center" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Judul Berita</td>
                                    <td>Kategori</td> 
                                    <td>Tipe Berita</td>  
                                    <td>Total Pembaca</td>                                                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>      
                                @foreach($pembaca_terbanyak as $pembaca_terbanyaks)                  
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>                            
                                    <td>{{ $pembaca_terbanyaks->judul }}</td>
                                    <td>{{ $pembaca_terbanyaks->nama_kategori }}</td>
                                    <td>{{ $pembaca_terbanyaks->tipe_berita }}</td>
                                    <td>{{ $pembaca_terbanyaks->viewer }}</td>
                                </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="col-8 col-lg-9 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                        <h6 style="font-size:14px;">Top 5 Berita Dengan Komentar Terbanyak</h6>                        
                    </div>                    
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold text-center" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Judul Berita</td>                                                                      
                                    <td>Total Komentar</td>                                                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>      
                                @foreach($komentar_terbanyak as $komentar_terbanyaks)                  
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>                            
                                    <td>{{ $komentar_terbanyaks->judul }}</td>                                                                        
                                    <td>{{ $komentar_terbanyaks->total_komentar }}</td>
                                </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="col-7 col-lg-5 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                        <h6 style="font-size:14px;">Top 5 Berita Paling Banyak Disukai</h6>                        
                    </div>                    
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold text-center" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Judul Berita</td>                                    
                                    <td>Total Disukai</td>                                                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>      
                                @foreach($disukai_terbanyak as $disukai_terbanyaks)                  
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>                            
                                    <td>{{ $disukai_terbanyaks->judul }}</td>                                   
                                    <td>{{ $disukai_terbanyaks->total_disukai }}</td>
                                </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection