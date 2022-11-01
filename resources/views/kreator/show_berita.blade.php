@extends('../layouts.app')

@section('title', 'Berita')

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
            <form id="form" action="{{ route('kreator.berita.search') }}"  method="get" class="mb-2">
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
                    <a href="{{ route('kreator.berita.tambah') }}" class="btn btn-sm btn-info">Tambah Berita</a>            
                    <div class="table-responsive mt-2">
                        <table class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Judul Berita</td>
                                    <td>Tipe Berita</td>
                                    <td>Kategori</td>
                                    <td>Tanggal Pembuatan</td>                                                                                                       
                                    <td>Status</td>
                                    <td>Total Pembaca</td> 
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php $no = 1; ?>
                                @foreach($data as $datas)
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->judul }}</td>
                                    <td>{{ $datas->tipe_berita }}</td>
                                    <td>{{ $datas->nama_kategori }}</td>
                                    <td>{{ $datas->created_at }}</td>
                                    <td>
                                        @if($datas->status == "rilis")
                                            <span class="badge rounded-pill bg-success text-light">{{ $datas->status }}</span>
                                        @elseif($datas->status == "menunggu")
                                            <span class="badge rounded-pill bg-warning text-dark">{{ $datas->status }}</span>
                                        @elseif($datas->status == "gagal")
                                            <span class="badge rounded-pill bg-danger text-light">{{ $datas->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $datas->viewer }}</td>
                                    <td>                                        
                                        <button type="button" class="btn btn-sm btn-dark mb-1" data-bs-toggle="modal" data-bs-target="#showBerita_{{ $datas->slug }}">
                                        <i class="fas fa-eye"></i>
                                        </button>                                        
                                        <div class="modal fade" id="showBerita_{{ $datas->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Berita</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <h4 class="text-center">{{ $datas->judul }}</h4>
                                                            <img src="{{ asset('image/cover/'.$datas->cover) }}" class="img-fluid" alt="">
                                                            <div class="mt-2" align="justify">
                                                                {!! $datas->deskripsi !!}
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ url('/kreator/berita/edit/'.$datas->id_berita) }}" class="btn btn-sm btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                        <a href="{{ url('/kreator/berita/delete/'.$datas->id_berita) }}" class="btn btn-sm btn-danger mb-1"><i class="fas fa-trash-alt"></i></a>
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

