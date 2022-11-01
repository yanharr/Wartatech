<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Berita;
use Auth;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $data = DB::table('berita')
                    ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                    ->join('users', 'users.id', '=', 'berita.id_users')
                    ->select('berita.id_berita', 'berita.id_kategori', 'berita.id_users',
                            'berita.judul', 'kategori.nama_kategori', 'berita.created_at',
                            'berita.status', 'berita.slug', 'berita.cover', 'berita.deskripsi',
                            'berita.tipe_berita', 'berita.viewer')
                    ->where('berita.id_users', Auth::user()->id)
                    ->orderBy('berita.created_at', 'DESC')
                    ->get();

        return view('kreator.show_berita', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();

        return view('kreator.tambah_berita', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_users' => 'required',
            'id_kategori' => 'required',
            'tipe_berita' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg|dimensions:width=1280,height=720',
            'judul' => 'required|unique:berita',
            'deskripsi' => 'required'
        ]);

        $cover = time().'.'.$request->cover->extension();
        $request->cover->move(public_path('image/cover'), $cover);

        if($request->tipe_berita == "Gratis"){
            $berita = Berita::create([
                'id_users' => $request->id_users,
                'id_kategori' => $request->id_kategori,   
                'tipe_berita' => $request->tipe_berita,
                'cover' => $cover,
                'judul' => $request->judul,
                'slug' => \Str::slug($request->judul),
                'deskripsi' => $request->deskripsi,
                'status' => "menunggu",
                'harga' => 0
            ]);
        }elseif($request->tipe_berita == "Berbayar"){
            $berita = Berita::create([
                'id_users' => $request->id_users,
                'id_kategori' => $request->id_kategori,  
                'tipe_berita' => $request->tipe_berita,                      
                'cover' => $cover,
                'judul' => $request->judul,
                'slug' => \Str::slug($request->judul),
                'deskripsi' => $request->deskripsi,
                'status' => "menunggu",
                'harga' => NULL
            ]);
        }        

        return redirect(route('kreator.berita'))->with('success', 'Data Berhasil Ditambahkan');
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $data = Berita::find($id);
        $kategori = Kategori::all();

        return view('kreator.edit_berita', compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Berita::find($id);                    

        $validate = $request->validate([
            'id_users' => 'required',
            'id_kategori' => 'required',            
            'cover_new' => 'image|mimes:jpeg,png,jpg',
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        $data->id_users = $request->id_users;
        $data->id_kategori = $request->id_kategori;        
        $data->judul = $request->judul;
        $data->slug = \Str::slug($request->judul);
        $data->deskripsi = $request->deskripsi;
        $data->status = "menunggu";

        if($request->cover_new == NULL){
            $data->cover = $request->cover;
        }else{
            $cover = time().'.'.$request->cover_new->extension();
            $request->cover_new->move(public_path('image/cover'), $cover);
            $data->cover = $cover;
        }        
        $data->save();
        
        return redirect(route('kreator.berita'))->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('berita')->where('id_berita', $id)->delete();        

        return redirect(route('kreator.berita'))->with('success', 'Data Berhasil Dihapus');
    }        

    public function searchBerita(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('berita')
                    ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                    ->join('users', 'users.id', '=', 'berita.id_users')
                    ->select('berita.id_berita', 'berita.id_kategori', 'berita.id_users',
                            'berita.judul', 'kategori.nama_kategori', 'berita.created_at',
                            'berita.status', 'berita.slug', 'berita.cover', 'berita.deskripsi',
                            'berita.tipe_berita')
                    ->where('berita.id_users', Auth::user()->id)
                    ->orderBy('berita.created_at', 'DESC')
                    ->where('judul', 'like', "%". $keyword . "%")
                    ->get();                
                         
        return view('kreator.show_berita', compact('data'));
    }
}

