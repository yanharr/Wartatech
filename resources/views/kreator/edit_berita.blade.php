@extends('../layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container">    
    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card">                                
                <div class="card-body">        
                    <form action="{{ url('/kreator/berita/update/'.$data->id_berita) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Judul Berita</label>
                            <input type="text" class="form-control form-control-sm @error('judul') is-invalid @enderror" name="judul" value="{{ $data->judul }}">
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
                                    <option value="{{ $kategoris->id_kategori }}" {{ $data->id_kategori == $kategoris->id_kategori ? 'selected' : '' }}>{{ $kategoris->nama_kategori }}</option>
                                @endforeach                                
                            </select>                            
                            @error('id_kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>   
                        <div class="form-group mb-2">
                            <label for="">Cover</label>
                            <input type="file" class="form-control form-control-sm" name="cover_new">
                            <input type="text" name="cover" value="{{ $data->cover }}" hidden>                            
                        </div>                      
                        <div class="form-group mb-2">
                            <label for="">Deskripsi Berita</label>
                            <textarea name="deskripsi" id="editor" class="form-control form-control-sm @error('deskripsi') is-invalid @enderror">{{ $data->deskripsi }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>       
                        <input type="text" name="id_users" value="{{Auth::user()->id}}" hidden>                    
                        <button class="btn btn-sm btn-info mt-2" type="submit">Perbarui</button>
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