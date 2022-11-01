<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;
    protected $table = "topup";
    public $primaryKey = 'id_topup';
    protected $fillable = [
        'id_topup',
        'id_users',
        'nominal',
        'status_pembayaran'
    ]; 
}
