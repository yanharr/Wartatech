@extends('layouts.template')

@section('title', 'Tech & Life')

@section('content')
<div class="container mt-4">
    <div class="col-12 col-md-12 col-lg-12 mb-2">
        <form id="form" action="{{ route('techNlife.search') }}"  method="get" class="mb-2">
            <div class="row g-2">
                <div class="col-10 col-md-11 col-lg-11">
                    <input class="form-control rounded" type="text" name="search" placeholder="Cari Disini...">
                </div>
                <div class="col-2 col-md-1 col-lg-1">
                    <button class="btn btn-info rounded" type="submit"><i class="fas fa-search"></i> &nbspCari&nbsp</button>
                </div>                    
            </div>
        </form> 
    </div>    
    <div class="card mb-3">
        <div class="card-body">
            <div class="col-4 col-lg-2 text-center mt-2" style="border-bottom:2px solid #788BFF;">
                <h5>Tech & Life</h5>                        
            </div> 
            <div class="col-12 col-md-12 col-lg-12 mt-4">     
                @foreach($data as $datas)                   
                <div class="row g-0 mb-4">
                    <div class="col-4">
                        <img src="{{ asset('image/cover/'.$datas->cover) }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-8">
                        <div class="align-items-start ms-3 ">
                            <h4 class=""><a href="{{ url('/berita/'.$datas->slug.'/'.Crypt::encrypt($datas->tipe_berita)) }}" class="text-decoration-none">{{ $datas->judul }}</a></h4>
                            <div class="card-text mb-1"style="font-size:12px;">
                                @if($datas->nama_kategori == "News")
                                    <span class="badge bg-primary">{{ $datas->nama_kategori }}</span>
                                @elseif($datas->nama_kategori == "Tips & Trick")
                                    <span class="badge bg-success">{{ $datas->nama_kategori }}</span>
                                @elseif($datas->nama_kategori == "Tech & Life")
                                    <span class="badge" style="background-color:#e0d724;">{{ $datas->nama_kategori }}</span>
                                @elseif($datas->nama_kategori == "Games")
                                    <span class="badge" style="background-color:#aa22bf;">{{ $datas->nama_kategori }}</span>
                                @endif
                            </div>
                            <div class="card-text mb-2" style="font-size:13px;">{!! $datas->deskripsi_singkat !!}...</div>
                            <div class="card-text">
                                @if($datas->google_id == NULL)
                                <img src="{{ asset('image/profile/'.$datas->foto_profile) }}" class="rounded-circle" width="6%">
                                @else
                                <img src="{{ $datas->foto_profile }}" class="rounded-circle" width="6%">
                                @endif
                                <small class="text-muted ms-2">{{ $datas->name }} - {{ Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach          
            </div>
        </div>
    </div>
</div>
@endsection