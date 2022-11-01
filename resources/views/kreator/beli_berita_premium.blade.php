@extends('../layouts.app')

@section('title', 'Beli Berita Premium')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5><i class="icon fas fa-times"></i> Gagal!</h5>
                    {{ session('error') }}
                </div>                                                            
            @endif 
            <div class="card">                                
                <div class="card-body">        
                    <form action="{{ route('kreator.berita.premium.beli.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Judul Berita</label>
                            <input type="text" class="form-control form-control-sm @error('judul') is-invalid @enderror" name="judul" value="{{ request()->judul }}" readonly>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>       
                        <div class="form-group mb-2">
                            <label for="">Total Harga</label>
                            <input type="text" class="form-control form-control-sm @error('total_harga') is-invalid @enderror" name="total_harga" value="{{ request()->total_harga }}" readonly hidden>
                            <input type="text" class="form-control form-control-sm @error('total_harga') is-invalid @enderror" value="Rp. {{ number_format(request()->total_harga, 0, '', '.') }}" readonly>
                            @error('total_harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>      
                        <div class="form-group mb-1">
                            <label for="">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select form-select-sm">
                                <option value="Saldo WartaPay">Saldo WartaPay</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                            </select>    
                            <div class="text-muted" style="font-size:12px;">
                                <i class="fas fa-money-bill-wave-alt mt-1"></i> Saldo WartaPay : Rp. {{ number_format(Auth::user()->saldo, 0, '', '.') }}
                            </div>                                                    
                            @error('total_harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                                                                                                                              
                        <input type="text" name="id_users" value="{{Auth::user()->id}}" hidden>                    
                        <input type="text" name="id_berita" value="{{request()->id_berita}}" hidden>                    
                        <button class="btn btn-sm btn-info mt-2" type="submit">Beli</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection