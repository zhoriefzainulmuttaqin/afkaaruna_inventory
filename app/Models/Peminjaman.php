<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['tgl_peminjaman', 'tgl_pengembalian', 'peminjam', 'keterangan', 'id_barang'];
}
