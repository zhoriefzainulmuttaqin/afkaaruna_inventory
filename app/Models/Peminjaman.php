<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'peminjaman';
    protected $fillable = [
        'tgl_peminjaman',
        'tgl_pengembalian',
        'peminjam',
        'keterangan',
        'id_barang'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
