<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = "like";
    public $primaryKey = 'id_like';
    protected $fillable = [
        'id_like',
        'id_users',
        'id_berita'
    ]; 
    public $timestamps = false;
}
