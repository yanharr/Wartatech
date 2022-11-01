<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BeritaPremiumCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = Berita::where('tipe_berita', 'Gratis')->first();
        
        if($check == "Gratis"){
            echo "Berhasil";
            // return $next($request);
        }        
        return redirect('/')->with('error', "Anda Tidak Dapat Mengakses Halaman Ini !!");
    }
}
