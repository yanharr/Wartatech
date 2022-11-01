<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Komentar extends Model
{
    use HasFactory;

    protected $table = "komentar";
    public $primaryKey = 'id_komentar';
    protected $fillable = [
        'id_komentar',
        'id_users',
        'id_berita',
        'deskripsi_komentar'        
    ]; 
   
}
