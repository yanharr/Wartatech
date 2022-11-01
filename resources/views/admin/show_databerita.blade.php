@extends('../layouts.app')

@section('title', 'Data Berita')

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
            <form id="form" action="{{ route('admin.databerita.search') }}"  method="get" class="mb-2">
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
                                    <td>Kategori</td>
                                    <td>Tipe Berita</td>
                                    <td>Nama Kreator</td>                                    
                                    <td>Tanggal Pembuatan</td>
                                    <td>Status</td>
                                    <td>Harga</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $datas)
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->judul }}</td>
                                    <td>{{ $datas->nama_kategori }}</td>
                                    <td>{{ $datas->tipe_berita }}</td>
                                    <td>{{ $datas->name }}</td>
                                    <td>{{ $datas->created_at }}</td>
                                    <td>
                                        @if($datas->status == "menunggu")
                                            @if($datas->harga == NULL)
                                                -
                                            @else
                                            <form action="{{ url('/admin/databerita/successstatus/'. $datas->id_berita) }}" method="post">
                                                @csrf
                                                <input type="text" value="rilis" name="status" hidden>
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>                                                
                                            </form>
                                            <form action="{{ url('/admin/databerita/gagalstatus/'. $datas->id_berita) }}" class="mt-1" method="post">
                                                @csrf
                                                <input type="text" value="gagal" name="status" hidden>
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>                                              
                                            </form>
                                            @endif
                                        @else
                                            @if($datas->status == "rilis")
                                                <span class="badge rounded-pill bg-success text-light">{{ $datas->status }}</span>
                                            @elseif($datas->status == "gagal")
                                                <span class="badge rounded-pill bg-danger text-light">{{ $datas->status }}</span>
                                            @endif
                                        @endif
                                    </td>    
                                    <td>
                                        @if($datas->tipe_berita == "Berbayar")
                                            {{ $datas->harga }}
                                        @else
                                            -
                                        @endif
                                    </td>                                                                   
                                    <td>           
                                        @if($datas->tipe_berita == "Berbayar" && $datas->harga == NULL)   
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#sethargaBerita"><i class="fas fa-dollar-sign"></i></button>
                                            <!-- open modal -->
                                            <div class="modal fade" id="sethargaBerita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Harga Berita </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/admin/databerita/'.$datas->id_berita) }}" method="post">
                                                            @csrf
                                                                <div class="form-group mt-2">
                                                                    <label for="">Judul berita</label>
                                                                    <input type="text" name="judul" class="form-control form-control-sm" value="{{ $datas->judul }}">
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <label for="">Harga</label>
                                                                    <input type="number" min="0" name="harga" class="form-control form-control-sm  @error('harga') is-invalid @enderror">
                                                                    @error('harga')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#showDataBerita_{{ $datas->slug }}">
                                        <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <div class="modal fade" id="showDataBerita_{{ $datas->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <a href="{{ url('/admin/databerita/delete/'.$datas->id_berita) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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