@extends('../layouts.app')

@section('title', 'Data User')

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
            <form id="form" action="{{ route('admin.datakreator.search') }}"  method="get" class="mb-2">
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
                        <table class="table table-hover" class="table table-hover" style="margin:0 auto; border-collapse:collapse;background:#FFFFFF">
                            <thead>
                                <tr class="fw-bold" style="border-bottom:0px solid #788BFF;padding:8px 0;background: #ffffff; color:#788BFF;">
                                    <td>No</td>
                                    <td>Nama Kreator</td>
                                    <td>Alamat Email</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Tanggal Lahir</td>
                                    <td>Alamat</td>
                                    <td>Nomor HP</td>
                                    <td>Saldo</td>                                    
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $datas)
                                <tr style="border-bottom: 1px solid #788BFF;padding:4px 8px;">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datas->name }}</td>
                                    <td>{{ $datas->email }}</td>
                                    <td>{{ $datas->jenis_kelamin }}</td>
                                    <td>{{ $datas->tgl_lahir }}</td>
                                    <td>{{ $datas->alamat }}</td>
                                    <td>{{ $datas->no_hp }}</td>
                                    <td>{{ $datas->saldo }}</td>                                                                      
                                    <td>                                        
                                        <a href="{{ url('/admin/datakreator/delete/'.$datas->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
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