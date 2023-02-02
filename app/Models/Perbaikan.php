<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table = 'perbaikan';
    protected $fillable = ['tgl_mulai', 'tgl_selesai', 'biaya', 'id_barang', 'keterangan'];
}
