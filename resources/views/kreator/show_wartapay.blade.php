@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">    
    <div class="col-12 col-md-12 col-lg-12 mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ session('success') }}
            </div>                                                            
        @endif 
        <form id="form" action="{{ route('kreator.wartapay.search') }}"  method="get" class="mb-2">
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
                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#topupsaldo">
                Isi Saldo
                </button>                
                <div class="modal fade" id="topupsaldo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Isi Saldo WartaPay</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('kreator/wartapay/isi') }}" method="post">
                                @csrf
                                    <input type="hidden" name="id_users" value="{{ Auth::user()->id }}">
                                    <div class="form-group">
                                        <label for="">Nominal</label>
                                        <input type="number" min=0 name="nominal" class="form-control form-control-sm @error('nominal') is-invalid @enderror">
                                        @error('nominal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-sm btn-success">Isi Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                        <thead>
                            <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                <td>No</td>
                                <td>Nominal</td>
                                <td>Tanggal Transaksi</td>
                                <td>Status Transaksi</td>
                                <td>Action</td>
                            </tr>                            
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($data as $datas)
                            <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                <td>{{ $no++ }}</td>
                                <td>+ {{ $datas->nominal }}</td>
                                <td>{{ $datas->created_at }}</td>
                                <td>{{ $datas->status_pembayaran }}</td>
                                <td>
                                    @if($datas->status_pembayaran == "Belum Lunas")
                                    <!-- Button trigger modal -->
                                    <button type="button"  class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#tatacarabayar">
                                        <i class="fas fa-money-bill-wave-alt"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="tatacarabayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tata Cara Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-start">
                                                        <h6 class="fw-bold">Cara Transfer Virtual Account Via ATM</h6>
                                                        <p class="fw-lighter">
                                                            <table class="table table-borderless">
                                                                <tr>
                                                                    <td>1</td>                                                                            
                                                                    <td>Masukkan kartu ATM</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>                                                                            
                                                                    <td>Masukkan 6 digit PIN ATM</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>                                                                            
                                                                    <td>Pilih menu Transaksi Lainnya > Transfer > Antar Bank Online</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>                                                                            
                                                                    <td>
                                                                        Masukkan Kode Bank BCA (014) + 12 Digit Nomor Telepon Anda (Pastikan Anda Sudah Memasukkan 
                                                                        Nomor Telepon Anda di Profile Anda)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>                                                                            
                                                                    <td>Pastikan nominal yang muncul di layar sudah sesuai dengan nominal yang diperlukan.</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>                                                                            
                                                                    <td>Pilih OK atau YES</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>                                                                            
                                                                    <td>Selesai</td>
                                                                </tr>
                                                            </table>                                                                   
                                                        </p>
                                                    </div>
                                                    <hr>
                                                    <div class="text-start">
                                                        <h6 class="fw-bold">Cara Transfer Virtual Account Via M-Banking</h6>
                                                        <p class="fw-lighter">
                                                            <table class="table table-borderless">
                                                                <tr>
                                                                    <td>1</td>                                                                            
                                                                    <td>Akses Aplikasi M-Banking kemudian masukkan user ID dan password</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>                                                                            
                                                                    <td>Pilih menu "Transfer"</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>                                                                            
                                                                    <td>Klik menu "Virtual Account"</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>                                                                            
                                                                    <td>
                                                                        Masukkan nomor Virtual Account (014) + 12 Digit Nomor Telepon (Pastikan Anda Sudah Memasukkan 
                                                                        Nomor Telepon Anda di Profile Anda)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>                                                                            
                                                                    <td>Masukkan jumlah yang ingin dibayarkan</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>                                                                            
                                                                    <td>Validasi pembayaran anda</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>                                                                            
                                                                    <td>Selesai</td>
                                                                </tr>
                                                            </table>                                                                   
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>                                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@endsection