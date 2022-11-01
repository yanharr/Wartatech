@extends('../layouts.app')

@section('title', 'Transaksi Berita Premium')

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
            <form id="form" action="{{ route('admin.transaksi.beritapremium.search') }}"  method="get" class="mb-2">
                <div class="row g-1">
                    <div class="col-10 col-md-11 col-lg-11">
                        <input class="form-control rounded" type="text" name="search" placeholder="Cari Disini...">
                    </div>
                    <div class="col-2 col-md-1 col-lg-1">
                        <button class="btn btn-info rounded" type="submit"><i class="fas fa-search"></i> Cari</button>
                    </div>                    
                </div>
            </form> 
            <div class="card">                                
                <div class="card-body">                            
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Judul Berita</td>                                    
                                    <td>Nama Pembeli</td>
                                    <td>Tanggal Transaksi</td>                                    
                                    <td>Harga</td>   
                                    <td>Status Pembayaran</td>
                                    <td>Action</td>                                 
                                </tr>
                            </thead>
                            <tbody>         
                                <?php $no = 1; ?>                       
                                @foreach($data as $datas)
                                    <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas->judul }}</td>                                        
                                        <td>{{ $datas->name }}</td>
                                        <td>{{ $datas->tanggal_transaksi }}</td>
                                        <td>{{ $datas->total_harga }}</td>
                                        <td>{{ $datas->status_pembayaran }}</td>
                                        <td>
                                            @if($datas->status_pembayaran == "Belum Lunas")
                                            <form action="{{ url('/admin/transaksi/berita-premium/konfirmasi-pembayaran/'.$datas->id_transaksi) }}" method="post">
                                            @csrf
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>     
                                            </form>                                            
                                            <a href="{{ url('/admin/transaksi/berita-premium/hapus-transaksi/'.$datas->id_transaksi) }}" class="btn btn-sm btn-danger mt-1"><i class="fas fa-times"></i></a> 
                                            @elseif($datas->status_pembayaran == "Lunas")
                                            -
                                            @endif
                                        </td>
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