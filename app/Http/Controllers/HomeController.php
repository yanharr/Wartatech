<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Berita;
use App\Models\Komentar;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Crypt;


class HomeController extends Controller
{    
    public function index()
    {
        $news = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                        'berita.created_at', 'users.name','berita.slug', 'berita.tipe_berita', 'users.google_id',
                        'users.foto_profile', \DB::raw('SUBSTRING(berita.deskripsi, 1, 110) as deskripsi_singkat'))   
                ->where('berita.status', 'rilis')
                ->where('berita.tipe_berita', 'Gratis')
                ->where('kategori.nama_kategori', 'News')
                ->orderBy('berita.created_at', 'desc')  
                ->limit(3)               
                ->get();   
        $tipsNtrick = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                        'berita.created_at', 'users.name','berita.slug', 'berita.tipe_berita', 'users.google_id',
                        'users.foto_profile', \DB::raw('SUBSTRING(berita.deskripsi, 1, 110) as deskripsi_singkat'))   
                ->where('berita.status', 'rilis')
                ->where('berita.tipe_berita', 'Gratis')
                ->where('kategori.nama_kategori', 'Tips & Trick')
                ->orderBy('berita.created_at', 'desc')    
                ->limit(3)              
                ->get();    
        $techNlife = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                        'berita.created_at', 'users.name','berita.slug', 'berita.tipe_berita', 'users.google_id',
                        'users.foto_profile', \DB::raw('SUBSTRING(berita.deskripsi, 1, 110) as deskripsi_singkat'))   
                ->where('berita.status', 'rilis')
                ->where('berita.tipe_berita', 'Gratis')
                ->where('kategori.nama_kategori', 'Tech & Life')
                ->orderBy('berita.created_at', 'desc')    
                ->limit(3)              
                ->get();                           
        $games = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                        'berita.created_at', 'users.name','berita.slug', 'berita.tipe_berita', 'users.google_id',
                        'users.foto_profile', \DB::raw('SUBSTRING(berita.deskripsi, 1, 110) as deskripsi_singkat'))   
                ->where('berita.status', 'rilis')
                ->where('berita.tipe_berita', 'Gratis')
                ->where('kategori.nama_kategori', 'Games')
                ->orderBy('berita.created_at', 'desc')    
                ->limit(3)              
                ->get();  
        $berita_terkini = DB::table('berita')
                        ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                        ->join('users', 'users.id', '=', 'berita.id_users')
                        ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                                'berita.created_at', 'users.name','berita.slug', 'berita.tipe_berita', 'users.google_id',
                                'users.foto_profile', \DB::raw('SUBSTRING(berita.deskripsi, 1, 182) as deskripsi_singkat'))   
                        ->where('berita.status', 'rilis')
                        ->where('berita.tipe_berita', 'Gratis')                        
                        ->orderBy('berita.created_at', 'desc')    
                        ->limit(3)              
                        ->get();      
        $berita_premium = DB::table('berita')
                        ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                        ->join('users', 'users.id', '=', 'berita.id_users')
                        ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                                'berita.slug', 'berita.tipe_berita')   
                        ->where('berita.status', 'rilis')
                        ->where('berita.tipe_berita', 'Berbayar')                        
                        ->orderBy('berita.created_at', 'desc')    
                        ->limit(5)              
                        ->get();                                           
        $total_kategori = DB::table('berita')                    
                        ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                        ->select('kategori.nama_kategori', DB::raw('count(berita.id_berita) AS total'))
                        ->where('berita.status', '=', 'rilis')                        
                        ->groupBy('kategori.id_kategori')                                                    
                        ->get(); 
        $berita_trending_first = DB::table('berita')
                        ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                        ->join('users', 'users.id', '=', 'berita.id_users')
                        ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                                'berita.slug', 'berita.tipe_berita', 'berita.viewer',
                                \DB::raw('SUBSTRING(berita.deskripsi, 1, 150) as deskripsi_singkat'))   
                        ->where('berita.status', 'rilis')
                        ->where('berita.tipe_berita', 'Gratis')                                                                                      
                        ->first(); 
        $berita_trending = DB::table('berita')
                        ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                        ->join('users', 'users.id', '=', 'berita.id_users')
                        ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                                'berita.slug', 'berita.tipe_berita', 'berita.viewer',
                                \DB::raw('SUBSTRING(berita.deskripsi, 1, 150) as deskripsi_singkat'))   
                        ->where('berita.status', 'rilis')
                        ->where('berita.tipe_berita', 'Gratis')                                                
                        ->orderBy('berita.viewer', 'desc')    
                        ->limit(2)              
                        ->get();

        return view('index', compact('news', 'tipsNtrick', 'techNlife', 'games', 'berita_terkini',
                                'berita_premium', 'berita_trending', 'total_kategori',
                                'berita_trending_first'));
    }

    public function commonShowBerita($slug, $token)
    {        
        $check = Crypt::decrypt($token);

        if($check === "Gratis"){
                $query = DB::table('berita')
                        ->where('berita.slug', $slug);
                $query->increment('viewer');                                    
                
                $data = DB::table('berita')
                                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                                ->join('users', 'users.id', '=', 'berita.id_users')
                                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                                        'berita.created_at', 'berita.deskripsi', 'berita.cover', 'users.google_id',
                                        'berita.slug', 'users.name', 'users.foto_profile', 'berita.viewer')
                                ->where('berita.slug', $slug)
                                ->first();                
                
                $komentar = DB::table('komentar')
                                ->join('berita', 'berita.id_berita', '=', 'komentar.id_berita')
                                ->join('users', 'users.id', '=', 'komentar.id_users')
                                ->select('komentar.id_users', 'komentar.id_komentar', 'komentar.id_berita',
                                        'users.foto_profile', 'users.name', 'komentar.deskripsi_komentar',
                                        'komentar.created_at', 'berita.slug', 'users.google_id')
                                ->where('berita.slug', $slug)
                                ->orderby('komentar.created_at', 'desc')
                                ->get();

                $count_komentar = DB::table('komentar')
                                ->join('berita', 'berita.id_berita', '=', 'komentar.id_berita')
                                ->join('users', 'users.id', '=', 'komentar.id_users')                        
                                ->where('berita.slug', $slug)                        
                                ->count();                

                $count_like = DB::table('like')
                        ->join('berita', 'berita.id_berita', '=', 'like.id_berita')
                        ->join('users', 'users.id', '=', 'like.id_users')                        
                        ->where('berita.slug', $slug)
                        ->count();        
                        
                $berita_lainnya = DB::table('berita')
                        ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                        ->join('users', 'users.id', '=', 'berita.id_users')
                        ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 'berita.cover',
                                'berita.slug', 'berita.tipe_berita')   
                        ->where('berita.status', 'rilis')
                        ->where('berita.tipe_berita', 'Gratis')                        
                        ->orderBy('berita.created_at', 'desc')    
                        ->limit(5)              
                        ->get();   

            return view('show_common_berita', compact('data', 'komentar', 'count_komentar', 'count_like', 'berita_lainnya'));
        }elseif($check === "Berbayar"){
            return redirect(route('/'))->with('error', 'Anda Tidak Memiliki Hak Untuk Mengakses Halaman Tersebut');            
        }        
    }

    public function komentarBerita(Request $request)
    {
        $validate = $request->validate([
            'id_users' => 'required',
            'id_berita' => 'required',
            'deskripsi_komentar' => 'required'            
        ]);

        $berita = Komentar::create([
            'id_users' => $request->id_users,
            'id_berita' => $request->id_berita,                        
            'deskripsi_komentar' => $request->deskripsi_komentar            
        ]);

        return redirect()->back()->with('success', 'Komentar Berhasil Ditambahkan');
    }         
    
    public function showNews()
    {
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'News')
                ->orderBy('berita.created_at', 'desc') 
                ->get(); 

        return view('news', compact('data'));
    }

    public function showTipsNTrick()
    {
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'Tips & Trick')
                ->orderBy('berita.created_at', 'desc') 
                ->get(); 

        return view('tipsNtrick', compact('data'));
    }

    public function showTechNLife()
    {
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'Tech & Life')
                ->orderBy('berita.created_at', 'desc') 
                ->get(); 

        return view('techNlife', compact('data'));
    }

    public function showGames()
    {
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'Games')
                ->orderBy('berita.created_at', 'desc') 
                ->get(); 

        return view('games', compact('data'));
    }

    public function searchNews(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'News')
                ->orderBy('berita.created_at', 'desc') 
                ->where('berita.judul', 'like', "%". $keyword . "%")
                ->get(); 

        return view('news', compact('data'));
    }

    public function searchTipsNTrick(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'Tips & Trick')
                ->orderBy('berita.created_at', 'desc') 
                ->where('berita.judul', 'like', "%". $keyword . "%")
                ->get(); 

        return view('tipsNtrick', compact('data'));
    }

    public function searchTechNLife(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'Tech & Life')
                ->orderBy('berita.created_at', 'desc') 
                ->where('berita.judul', 'like', "%". $keyword . "%")
                ->get(); 

        return view('techNlife', compact('data'));
    }

    public function searchGames(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('berita')
                ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                ->join('users', 'users.id', '=', 'berita.id_users')
                ->select('berita.id_berita','berita.judul', 'kategori.nama_kategori', 
                        'berita.created_at', 'users.name','berita.slug', 'berita.cover', 'users.google_id',
                        'users.foto_profile', 'berita.deskripsi', 'berita.tipe_berita', 'berita.status',
                        \DB::raw('SUBSTRING(berita.deskripsi, 1, 245) as deskripsi_singkat')) 
                ->where('berita.tipe_berita', '=', 'Gratis')
                ->where('berita.status', '=', 'rilis')
                ->where('kategori.nama_kategori', '=', 'Games')
                ->orderBy('berita.created_at', 'desc') 
                ->where('berita.judul', 'like', "%". $keyword . "%")
                ->get(); 

        return view('games', compact('data'));
    }
}
