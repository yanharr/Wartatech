@extends('../layouts.app')

@section('title', 'Riwayat Isi Saldo WartaPay')

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
            <form id="form" action="{{ route('admin.riwayat.transaksi.topup.search') }}"  method="get" class="mb-2">
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
                    <div class="table-responsive mt-2" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                        <table class="table table-hover">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Nama</td>                                    
                                    <td>Nominal</td>
                                    <td>Tanggal Transaksi</td>                                                                           
                                    <td>Status Pembayaran</td>                                                                    
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>         
                                <?php $no = 1; ?>                       
                                @foreach($data as $datas)
                                    <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $datas->name }}</td>                                                                                
                                        <td>+ {{ $datas->nominal }}</td>
                                        <td>{{ $datas->tanggal_transaksi }}</td>
                                        <td>{{ $datas->status_pembayaran }}</td>    
                                        <td>
                                            @if($datas->status_pembayaran == "Belum Lunas")
                                            <form action="{{ url('/admin/transaksi/riwayat/top-up/'.$datas->id_topup) }}" method="post">                                                
                                            @csrf
                                                <input type="hidden" name="id_users" value="{{ $datas->id_users }}">
                                                <input type="hidden" name="nominal" value="{{ $datas->nominal }}">
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-money-check-alt"></i></button>
                                            </form>
                                            @elseif($datas->status_pembayaran == "Lunas")
                                            <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
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