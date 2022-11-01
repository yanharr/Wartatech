<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = "berita";
    public $primaryKey = 'id_berita';
    protected $fillable = [
        'id_berita',
        'id_users',
        'id_kategori',
        'tipe_berita',
        'cover',
        'judul',
        'slug',
        'deskripsi',
        'status',
        'viewer',
        'harga'
    ];    
}
