@extends('../layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card">                                
                <div class="card-body">        
                    <form action="{{ route('kreator.berita.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Judul Berita</label>
                            <input type="text" class="form-control form-control-sm @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" style="border:1px solid #788BFF;">
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     
                        <div class="form-group mb-2">
                            <label for="">Kategori</label>
                            <select name="id_kategori" class="form-select form-select-sm @error('id_kategori') is-invalid @enderror">
                                @foreach($kategori as $kategoris)                                    
                                    <option value="{{ $kategoris->id_kategori }}">{{ $kategoris->nama_kategori }}</option>
                                @endforeach                                
                            </select>                            
                            @error('id_kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>   
                        <div class="form-group mb-2">
                            <label for="">Tipe Berita</label>
                            <select name="tipe_berita" class="form-select form-select-sm @error('tipe_berita') is-invalid @enderror">
                                <option value="Gratis">Gratis</option>                                            
                                <option value="Berbayar">Berbayar</option>
                            </select>                            
                            @error('tipe_berita')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <div class="form-group mb-2">
                            <label for="">Cover</label>
                            <input type="file" class="form-control form-control-sm @error('cover') is-invalid @enderror" name="cover" value="{{ old('cover') }}">
                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                      
                        <div class="form-group mb-2">
                            <label for="">Deskripsi Berita</label>
                            <textarea name="deskripsi" id="editor" class="form-control form-control-sm @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>       
                        <input type="text" name="id_users" value="{{Auth::user()->id}}" hidden>                    
                        <button class="btn btn-sm btn-info mt-2" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ck-editor')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection