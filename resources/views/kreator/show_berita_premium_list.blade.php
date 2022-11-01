@extends('../layouts.app')

@section('title', 'Berita Premium List')

@section('content')
<div class="container">    
    <div class="row mt-4">
        @foreach($data as $datas)
        <div class="col-12 col-md-12 col-lg-3 mb-2">
            <div class="card" style="height:400px; max-height:400px;">
                <img src="{{ asset('image/cover/'.$datas->cover) }}" style="width:100%; max-height:250px;" class="card-img-top">
                <div class="card-body">
                    <h6 class="card-title fw-bold" style="font-size:13px;">{{ $datas->judul }}</h6>                    
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center" style="font-size:11px;">{{ $datas->nama_kategori }}</li>
                    <li class="list-group-item text-center" style="font-size:11px;">{{ $datas->name }}</li>                    
                    <li class="list-group-item text-center" style="font-size:11px;">{{ Carbon\Carbon::parse($datas->created_at)->isoFormat('D MMMM Y')}}</li>                    
                    <li class="list-group-item text-center" style="font-size:11px;">Rp. {{ $datas->harga }}</li>                    
                </ul>
                <div class="card-footer text-center" style="background-color:rgb(255,255,255);">
                    <form action="{{ route('kreator.berita.premium.beli') }}" class="form-inline" method="get">                        
                        <input type="text" name="id_berita" value="{{ $datas->id_berita }}" hidden>
                        <input type="text" name="total_harga" value="{{ $datas->harga }}" hidden>
                        <input type="text" name="judul" value="{{ $datas->judul }}" hidden>
                        <button type="submit" class="btn btn-sm btn-info">Beli</button>                    
                    </form>                    
                </div>
            </div>
        </div>                                
        @endforeach      
    </div>
</div>
@endsection