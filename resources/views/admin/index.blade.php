@extends('../layouts.app')

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
                                    <li type="none">Total Kreator</li>
                                </h2>
                                <small style="font-size: 15px; color: white"> 
                                    <li type="none">{{ $user }}</li>
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
            <div class="card mt-4" style="background: #707FDD">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 ms-2">
                            <i class="fas fa-wallet fa-3x" style="color: white;"></i>
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
                            <i class="fas fa-book-reader fa-3x" style="color: white;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3 mt-1">
                            <a>
                                <h2 style="font-size: 17px; color: white">
                                    <li type="none">Total WartaPay</li>
                                </h2>
                                <small style="font-size: 15px; color: white"> 
                                    <li type="none">{{ $wartapay }}</li>
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
                    <div class="col-7 col-lg-6 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                        <h6 style="font-size:14px;">Top 5 Kreator Dengan Berita Terbanyak</h6>                        
                    </div>                    
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Alamat Email</td>
                                    <td>Nama Kreator</td>                                 
                                    <td>Total Berita</td>                                                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>      
                                @foreach($total_berita as $total_beritas)
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $total_beritas->email }}</td>
                                    <td>{{ $total_beritas->name }}</td>
                                    <td>{{ $total_beritas->total }}</td>
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
                    <div class="col-6 col-lg-7 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                        <h6 style="font-size:14px;">Top 5 Top Up WartaPay Terbanyak</h6>                        
                    </div>                    
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Alamat Email</td>
                                    <td>Nama Kreator</td>                                 
                                    <td>Total Saldo</td>                                                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>      
                                @foreach($total_wartapay as $total_wartapays)
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $total_wartapays->email }}</td>
                                    <td>{{ $total_wartapays->name }}</td>
                                    <td>{{ $total_wartapays->total }}</td>
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
                    <div class="col-8 col-lg-7 text-center mt-1 mb-3" style="border-bottom:2px solid #788BFF;">
                        <h6 style="font-size:14px;">Top 5 Pembelian Berita Premium Terbanyak</h6>                        
                    </div>                    
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Alamat Email</td>
                                    <td>Nama Kreator</td>                                 
                                    <td>Total Berita</td>                                                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>      
                                @foreach($total_berita_premium as $total_berita_premiums)
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $total_berita_premiums->email }}</td>
                                    <td>{{ $total_berita_premiums->name }}</td>
                                    <td>{{ $total_berita_premiums->total }}</td>
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