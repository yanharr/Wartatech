<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Like;
use App\Models\Transaksi;
use App\Models\Topup;
use App\Models\Komentar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class KreatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $berita = DB::table('berita')->where('id_users', Auth::user()->id)->count();
        $pembaca = DB::table('berita')->where('id_users', Auth::user()->id)->sum('viewer');
        $berita_premium = DB::table('transaksi')
                            ->where('id_users', Auth::user()->id)
                            ->where('status_pembayaran', '=', 'Lunas')
                            ->count();    
        $pembaca_terbanyak = DB::table('berita')    
                            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                            ->where('id_users', Auth::user()->id)
                            ->orderBy('viewer', 'desc')
                            ->limit(5)
                            ->get();
        $komentar_terbanyak = DB::table('komentar')
                            ->join('berita', 'berita.id_berita', '=', 'komentar.id_berita')
                            ->select('berita.judul',DB::raw('count(komentar.id_komentar) AS total_komentar'))                         
                            ->where('komentar.id_users', Auth::user()->id)
                            ->orderBy('total_komentar','DESC')
                            ->groupBy('komentar.id_berita')                            
                            ->limit(5)
                            ->get();               
        $disukai_terbanyak = DB::table('like')
                            ->join('berita', 'berita.id_berita', '=', 'like.id_berita')
                            ->select('berita.judul',DB::raw('count(like.id_like) AS total_disukai'))                         
                            ->where('like.id_users', Auth::user()->id)
                            ->orderBy('total_disukai','DESC')
                            ->groupBy('like.id_berita')                            
                            ->limit(5)
                            ->get();                            
        
        return view('kreator.index', compact('berita', 'pembaca', 'berita_premium',
                    'pembaca_terbanyak', 'komentar_terbanyak', 'disukai_terbanyak'));
    }

    public function showProfile()
    {
        $data = DB::table('users')->where('id', Auth::user()->id)->first();

        return view('kreator.show_profile', compact('data'));
    }

    public function updateProfile(Request $request, $id)
    {
        $data = User::find($id);                    

        $validate = $request->validate([
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',            
            'alamat' => 'required',
            'no_hp' => 'required',
            'foto_profile_new' => 'image|mimes:jpeg,png,jpg'
        ]);

        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tgl_lahir = $request->tgl_lahir;        
        $data->alamat = $request->alamat;        
        $data->no_hp = $request->no_hp;        
        
        if($request->foto_profile_new == NULL){
            $data->foto_profile = $request->foto_profile;
        }else{
            $cover = time().'.'.$request->foto_profile_new->extension();
            $request->foto_profile_new->move(public_path('image/profile'), $cover);
            $data->foto_profile = $cover;
        }        
        $data->save();
        
        return redirect(route('kreator.profile.show'))->with('success', 'Data Berhasil Diubah');
    }

    public function editPasswordProfile($id)
    {
        $data = User::find($id);        

        return view('kreator.edit_password_profile', compact('data'));
    }

    public function updatePasswordProfile(Request $request, $id)
    {
        $data = User::find($id);        

        $validate = $request->validate([
            'password_lama' => 'required|string|min:8',
            'password' => 'required|string|confirmed|min:8'                      
        ]);
    
        $password_lama = $request->password_lama;        
        
        if(Hash::check($password_lama, $data->password)){
            if($password_lama != $request->password){
                $data->password = Hash::make($request->password);
                $data->save();

                return redirect(route('kreator.profile.show'))->with('success', 'Password Berhasil Diubah');
            }                
            else{
                return redirect()->back()->with("error","Password Baru dan Password Lama Tidak Boleh Sama");
            }
        }else{
            return redirect()->back()->with("error","Password Lama yang Anda Masukkan Salah");
        }                        

    }

    public function likeBerita(Request $request)
    {        
        $validate = $request->validate([            
            'id_users' => 'required',            
            'id_berita' => 'required'            
        ]);

        $check = DB::table('like')
            ->where('id_users', $request->id_users)
            ->where('id_berita', $request->id_berita)
            ->first();

        if($check === null){
            $like = Like::create([
                'id_users' => $request->id_users,
                'id_berita' => $request->id_berita                        
            ]);

            return redirect()->back()->with('success', 'Berhasil Menyukai Berita Ini');   
        }else{
            return redirect()->back()->with('error', 'Anda Sudah Menyukai Berita Ini');
        }        
    }

    public function dislikeBerita(Request $request, $slug)
    {        
        $check = DB::table('like')
            ->where('id_users', $request->id_users)
            ->where('id_berita', $request->id_berita)
            ->first();
        
        if($check != null){
            DB::table('like')
                ->where('id_users', $request->id_users)
                ->where('id_berita', $request->id_berita)
                ->delete();
                
            return redirect()->back()->with('success', 'Berhasil Berhenti Menyukai Berita Ini'); 
        }else{
            return redirect()->back()->with('error', 'Anda Sudah Berhenti Menyukai Berita Ini');
        }        
    }

    public function showBeritaPremium()
    {        
        $data = DB::table('transaksi')                    
                    ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                    ->join('users', 'users.id', '=', 'transaksi.id_users')
                    ->select('transaksi.id_transaksi', 'transaksi.id_berita', 'transaksi.id_users',
                            'berita.judul', 'berita.created_at AS tanggal_pembuatan',
                             'berita.slug', 'users.id')                                                                                                                     
                    ->where('transaksi.status_pembayaran', 'Lunas')
                    ->where('transaksi.id_users', Auth::user()->id)
                    ->orderBy('berita.judul', 'DESC')
                    ->get();

        return view('kreator.show_berita_premium', compact('data'));
    }

    public function showBeritaPremiumList()
    {
        $data = DB::table('berita')
                    ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                    ->join('users', 'users.id', '=', 'berita.id_users')
                    ->select('berita.id_berita', 'berita.id_kategori', 'berita.id_users',
                            'berita.judul', 'kategori.nama_kategori', 'berita.created_at',
                            'berita.status', 'berita.slug', 'berita.tipe_berita', 'berita.cover',
                            'users.name', 'berita.harga')
                    ->where('berita.id_users', '!=', Auth::user()->id)
                    ->where('berita.tipe_berita', 'Berbayar')
                    ->where('berita.status', 'rilis')
                    ->whereNotNull('berita.harga')
                    ->get();

        return view('kreator.show_berita_premium_list', compact('data'));
    }

    public function beliBeritaPremium()
    {
        return view('kreator.beli_berita_premium');
    }

    public function storeBeliBeritaPremium(Request $request)
    {
        $check = DB::table('transaksi')
                    ->where('id_users', $request->id_users)
                    ->where('id_berita', $request->id_berita)
                    ->first();

        $validate = $request->validate([
            'id_users' => 'required',
            'id_berita' => 'required',
            'metode_pembayaran' => 'required',
            'total_harga' => 'required'
        ]);

        if($check === NULL){
            if($request->metode_pembayaran == "Saldo WartaPay"){

                $data = User::find(Auth::user()->id);                
                                
                if(Auth::user()->saldo >= $request->total_harga){
                    $transaksi = Transaksi::create([
                        'id_users' => $request->id_users,
                        'id_berita' => $request->id_berita,
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'total_harga' => $request->total_harga,
                        'status_pembayaran' => "Lunas"
                    ]);  

                    $data->saldo = (Auth::user()->saldo) - ($request->total_harga);
                    $data->save();
                }else{
                    return redirect()->back()->with('error', 'Saldo WartaPay Anda Tidak Cukup Untuk Membeli Berita Premium Ini');
                }             
                
            }elseif($request->metode_pembayaran == "Transfer Bank"){
                $transaksi = Transaksi::create([
                    'id_users' => $request->id_users,
                    'id_berita' => $request->id_berita,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'total_harga' => $request->total_harga,
                    'status_pembayaran' => "Belum Lunas"
                ]);            
            }

            return redirect(route('kreator.berita.premium'))->with('success', 'Transaksi Pembelian Berita Premium Berhasil');
        }else{
            return redirect()->back()->with('error', 'Anda Sudah Membeli Berita Premium Ini');
        }                
    }  
    
    public function showRiwayatBeritaPremium()
    {
        $data = DB::table('transaksi')                    
                    ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                    ->join('users', 'users.id', '=', 'transaksi.id_users')
                    ->select('transaksi.id_transaksi', 'transaksi.id_berita', 'transaksi.id_users',
                            'berita.judul', 'transaksi.metode_pembayaran', 'transaksi.status_pembayaran',
                            'transaksi.created_at AS tanggal_transaksi', 'berita.slug', 'transaksi.total_harga')                                                                                                                                         
                    ->where('transaksi.id_users', Auth::user()->id)                  
                    ->orderBy('transaksi.created_at', 'DESC')
                    ->get();

        return view('kreator.show_riwayat_transaksi_berita-premium', compact('data'));
    }

    public function commonShowPremiumBerita($slug, $id_users, $id_berita)
    {
        $id_users_decrypt = Crypt::decrypt($id_users);
        $id_berita_decrypt = Crypt::decrypt($id_berita);

        $check = DB::table('transaksi')
                ->where('id_users',  $id_users_decrypt)
                ->where('id_berita', $id_berita_decrypt)
                ->first();
        
        $check_auth = DB::table('transaksi')
                        ->where('id_users', Auth::user()->id)
                        ->first();

        if($check === NULL){            
            return redirect(route('kreator.berita.premium'))->with('error', 'Anda Tidak Bisa Mengakses Halaman Tersebut');            
        }else{
            if($check_auth === NULL){
                return redirect(route('kreator.berita.premium'))->with('error', 'Anda Tidak Memiliki Hak Untuk Mengakses Halaman Tersebut');                
            }else{
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
                                    'users.foto_profile', 'users.name', 'komentar.deskripsi_komentar', 'users.google_id',
                                    'komentar.created_at', 'berita.slug')
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

                return view('show_premium_berita', compact('data', 'komentar', 'count_komentar', 'count_like'));
            }
        }        
    }

    public function showWartaPay()
    {
        $data = Topup::where('id_users', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('kreator.show_wartapay', compact('data'));
    }

    public function isiWartaPay(Request $request)
    {   
        $validate = $request->validate([
            'id_users' => 'required',
            'nominal' => 'required|numeric|min:10000'
        ]);

        $topup = Topup::create([
            'id_users' => $request->id_users,
            'nominal' => $request->nominal,
            'status_pembayaran' => 'Belum Lunas'
        ]);
        
        return redirect(route('kreator.wartapay'))->with('success', 'Isi Saldo Anda Berhasil, Silahkan Membayar Sesuai Dengan Nominal Yang Dimasukkan');
    }

    public function searchBeritaPremium(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('transaksi')                    
                    ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                    ->join('users', 'users.id', '=', 'transaksi.id_users')
                    ->select('transaksi.id_transaksi', 'transaksi.id_berita', 'transaksi.id_users',
                            'berita.judul', 'berita.created_at AS tanggal_pembuatan',
                             'berita.slug', 'users.id')                                                                                                                     
                    ->where('transaksi.status_pembayaran', 'Lunas')
                    ->where('transaksi.id_users', Auth::user()->id)
                    ->where('berita.judul', 'like', "%". $keyword . "%")
                    ->orderBy('berita.judul', 'DESC')
                    ->get();

        return view('kreator.show_berita_premium', compact('data'));
    }

    public function searchRiwayatBeritaPremium(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('transaksi')                    
                    ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                    ->join('users', 'users.id', '=', 'transaksi.id_users')
                    ->select('transaksi.id_transaksi', 'transaksi.id_berita', 'transaksi.id_users',
                            'berita.judul', 'transaksi.metode_pembayaran', 'transaksi.status_pembayaran',
                            'transaksi.created_at AS tanggal_transaksi', 'berita.slug', 'transaksi.total_harga')                                                                                                                                         
                    ->where('transaksi.id_users', Auth::user()->id)                  
                    ->orderBy('transaksi.created_at', 'DESC')
                    ->where('berita.judul', 'like', "%". $keyword . "%")
                    ->get();

        return view('kreator.show_riwayat_transaksi_berita-premium', compact('data'));
    }

    public function searchWartaPay(Request $request)
    {
        $keyword = $request->search;
        $data = Topup::where('id_users', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->where('created_at', 'like', "%". $keyword . "%")
                ->get();

        return view('kreator.show_wartapay', compact('data'));
    }

}
