@extends('../layouts.app')

@section('title', 'Show Berita')

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
            <div class="card">                                
                <div class="card-body">                            
                    <div class="h1 fw-bold fs-2 text-center">
                        {{ $data->judul }}
                    </div>                    
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <img src="{{ asset('image/cover/'.$data->cover) }}" class="img-fluid" alt="">
                        </div>  
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col-1">
                            <img src="{{ asset('image/profile/'.$data->foto_profile) }}" class="img-fluid" width="85%" alt="">
                        </div>  
                        <div class="col-11">
                            <div class="row">
                                <div class="col-12 mt-3 fw-bold">
                                    {{ $data->name }} &nbsp.&nbsp
                                    {{ $data->created_at }} &nbsp.&nbsp
                                    {{ $data->nama_kategori }} 
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <p class="text-md-start">  
                        {!! $data->deskripsi !!}
                    </p>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



<!-- <div class="d-flex">
  <div class="flex-shrink-0">
    <img src="..." alt="...">
  </div>
  <div class="flex-grow-1 ms-3">
    This is some content from a media component. You can replace this with any content and adjust it as needed.
  </div>
</div> -->