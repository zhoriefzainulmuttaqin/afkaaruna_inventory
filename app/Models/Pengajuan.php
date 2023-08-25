<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'pengajuan';
    protected $fillable = [
        'id_barang',
        'peminjam',
        'jumlahBarang',
        'tgl_peminjam',
        'id_status',
        'tgl_pengembalian',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
