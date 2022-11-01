<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Berita;
use App\Models\Transaksi;
use App\Models\Topup;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        $user = DB::table('users')->where('level', '=', 'user')->count();
        $berita = DB::table('berita')->where('tipe_berita', '=', 'Gratis')->count();
        $berita_premium = DB::table('berita')->where('tipe_berita', '=', 'Berbayar')->count();
        $wartapay = DB::table('topup')->count();
        $total_berita = DB::table('berita')
                    ->join('users', 'users.id', '=', 'berita.id_users')
                    ->select('users.name','users.email',DB::raw('count(berita.id_berita) AS total'))                                             
                    ->where('berita.status', '=', 'rilis')
                    ->orderBy('total','DESC')
                    ->groupBy('users.id')                            
                    ->limit(5)
                    ->get();   
        $total_wartapay = DB::table('topup')
                        ->join('users', 'users.id', '=', 'topup.id_users')
                        ->select('users.name','users.email',DB::raw('SUM(topup.nominal) AS total'))                                             
                        ->where('topup.status_pembayaran', '=', 'Lunas')
                        ->orderBy('total','DESC')
                        ->groupBy('users.id')                            
                        ->limit(5)
                        ->get();   
        $total_berita_premium = DB::table('transaksi')
                            ->join('users', 'users.id', '=', 'transaksi.id_users')
                            ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                            ->select('users.name','users.email', DB::raw('count(transaksi.id_transaksi) AS total'))                                             
                            ->where('transaksi.status_pembayaran', '=', 'Lunas')
                            ->orderBy('total','DESC')
                            ->groupBy('users.id')                            
                            ->limit(5)
                            ->get();   
        

        return view('admin.index', compact('user', 'berita', 'berita_premium', 'wartapay',
                                    'total_berita', 'total_wartapay', 'total_berita_premium'));
    }

    public function showKategori()
    {
        $data = Kategori::all();

        return view('admin.show_kategori', compact('data'));
    }

    public function tambahKategori()
    {
        return view('admin.tambah_kategori');
    }

    public function storeKategori(Request $request)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required'                       
        ]);        

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori                        
        ]);

        return redirect(route('admin.kategori'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function editKategori($id)
    {
        $data = Kategori::find($id);

        return view('admin.edit_kategori', compact('data'));
    }

    public function updateKategori(Request $request, $id)
    {
        $data = Kategori::find($id);                    

        $validate = $request->validate([
            'nama_kategori' => 'required'     
        ]);

        $data->nama_kategori = $request->nama_kategori;        
        
        $data->save();
        
        return redirect(route('admin.kategori'))->with('success', 'Data Berhasil Diubah');
    }

    public function deleteKategori($id)
    {
        DB::table('kategori')->where('id_kategori', $id)->delete();        

        return redirect(route('admin.kategori'))->with('success', 'Data Berhasil Dihapus');
    }

    public function showDataKreator()
    {
        $data = DB::table('users')
            ->where('level', 'user')
            ->get();

        return view('admin.show_datakreator', compact('data'));
    }

    public function deleteDataKreator($id)
    {
        DB::table('users')->where('id', $id)->delete();        

        return redirect(route('admin.datakreator'))->with('success', 'Data Berhasil Dihapus');
    }

    public function showDataBerita()
    {
        $data = DB::table('berita')
                    ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                    ->join('users', 'users.id', '=', 'berita.id_users')
                    ->select('berita.id_berita', 'berita.id_kategori', 'berita.id_users',
                            'berita.judul', 'kategori.nama_kategori', 'berita.created_at',
                            'berita.status', 'users.name', 'berita.tipe_berita', 
                            'berita.harga', 'berita.slug', 'berita.cover', 'berita.deskripsi')
                    ->orderBy('berita.created_at', 'desc')                    
                    ->get();

        return view('admin.show_databerita', compact('data'));
    }

    public function deleteDataBerita($id)
    {
        DB::table('berita')->where('id_berita', $id)->delete();        

        return redirect(route('admin.databerita'))->with('success', 'Data Berhasil Dihapus');
    }

    public function statusSuccessDataBerita(Request $request, $id)
    {
        $data = Berita::find($id);                            

        $data->status = $request->status;                
        $data->save();
        
        return redirect(route('admin.databerita'))->with('success', 'Status Berhasil Diubah');
    }

    public function statusGagalDataBerita(Request $request, $id)
    {
        $data = Berita::find($id);                            

        $data->status = $request->status;                
        $data->save();
        
        return redirect(route('admin.databerita'))->with('success', 'Status Berhasil Diubah');
    }

    public function sethargaBerita(Request $request, $id)
    {
        $data = Berita::find($id);   
        
        $validate = $request->validate([
            'harga' => 'required'     
        ]);

        $data->harga = $request->harga;        
        
        $data->save();

        return redirect(route('admin.databerita'))->with('success', 'Harga Berita Berhasil Ditambahkan');
    }

    public function showTransaksiBeritaPremium()
    {
        $data = DB::table('transaksi')                    
                    ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                    ->join('users', 'users.id', '=', 'transaksi.id_users')
                    ->select('transaksi.id_transaksi', 'transaksi.id_berita', 'transaksi.id_users',
                            'berita.judul', 'users.name', 'transaksi.status_pembayaran',
                            'transaksi.created_at AS tanggal_transaksi', 'berita.slug', 'transaksi.total_harga')                                                                                                                             
                    ->orderBy('transaksi.created_at', 'DESC')            
                    ->get();
        
        return view('admin.show_transaksi_berita-premium', compact('data'));
    }

    public function confirmTransaksiBeritaPremium(Request $request, $id)
    {
        $data = Transaksi::find($id); 

        $data->status_pembayaran = "Lunas";
        $data->save();

        return redirect(route('admin.transaksi.beritapremium'))->with('success', 'Pembayaran Berita Premium Berhasil Dikonfirmasi');
    }

    public function hapusTransaksiBeritaPremium($id)
    {
        DB::table('transaksi')->where('id_transaksi', $id)->delete();        

        return redirect(route('admin.transaksi.beritapremium'))->with('success', 'Pembayaran Berita Premium Berhasil Dibatalkan');
    }

    public function showRiwayatTransaksiTopUp()
    {
        $data = DB::table('topup')
                ->join('users', 'users.id', '=', 'topup.id_users')
                ->select('topup.id_topup', 'topup.id_users', 'users.name',
                        'topup.nominal', 'topup.created_at AS tanggal_transaksi',
                        'topup.status_pembayaran')
                ->orderBy('topup.created_at', 'desc')
                ->get();

        return view('admin.riwayat_transaksi_top-up', compact('data'));
    }

    public function confirmRiwayatTransaksiTopUp(Request $request, $id)
    {
        $data = Topup::find($id); 
        $topup = User::find($request->id_users);

        $data->status_pembayaran = "Lunas";
        $data->save();

        $topup->saldo = $topup->saldo + $request->nominal;
        $topup->save();

        return redirect(route('admin.riwayat.transaksi.topup'))->with('success', 'Pembayaran Isi Saldo WartaPay Berhasil Dikonfirmasi');
    }

    public function searchKategori(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('kategori')->where('nama_kategori', 'like', "%". $keyword . "%")->get();

        return view('admin.show_kategori', compact('data'));
    }

    public function searchDataKreator(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('users')
            ->where('level', 'user')
            ->where('name', 'like', "%". $keyword . "%")
            ->get();

        return view('admin.show_datakreator', compact('data'));

    }

    public function searchDataBerita(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('berita')
                    ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
                    ->join('users', 'users.id', '=', 'berita.id_users')
                    ->select('berita.id_berita', 'berita.id_kategori', 'berita.id_users',
                            'berita.judul', 'kategori.nama_kategori', 'berita.created_at',
                            'berita.status', 'users.name', 'berita.tipe_berita', 
                            'berita.harga', 'berita.slug', 'berita.cover', 'berita.deskripsi')
                    ->orderBy('berita.created_at', 'desc')    
                    ->where('berita.judul', 'like', "%". $keyword . "%")                
                    ->get();

        return view('admin.show_databerita', compact('data'));

    }

    public function searchTransaksiBeritaPremium(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('transaksi')                    
                    ->join('berita', 'berita.id_berita', '=', 'transaksi.id_berita')
                    ->join('users', 'users.id', '=', 'transaksi.id_users')
                    ->select('transaksi.id_transaksi', 'transaksi.id_berita', 'transaksi.id_users',
                            'berita.judul', 'users.name', 'transaksi.status_pembayaran',
                            'transaksi.created_at AS tanggal_transaksi', 'berita.slug', 'transaksi.total_harga')                                                                                                                             
                    ->orderBy('transaksi.created_at', 'DESC')   
                    ->where('users.name', 'like', "%". $keyword . "%")          
                    ->get();
        
        return view('admin.show_transaksi_berita-premium', compact('data'));
    }

    public function searchRiwayatTransaksiTopUp(Request $request)
    {
        $keyword = $request->search;
        $data = DB::table('topup')
                ->join('users', 'users.id', '=', 'topup.id_users')
                ->select('topup.id_topup', 'topup.id_users', 'users.name',
                        'topup.nominal', 'topup.created_at AS tanggal_transaksi',
                        'topup.status_pembayaran')
                ->orderBy('topup.created_at', 'desc')
                ->where('users.name', 'like', "%". $keyword . "%")  
                ->get();

        return view('admin.riwayat_transaksi_top-up', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
