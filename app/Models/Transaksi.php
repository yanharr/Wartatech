<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    public $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_users',
        'id_berita',
        'metode_pembayaran',
        'total_harga',
        'status_pembayaran'        
    ];  
}
