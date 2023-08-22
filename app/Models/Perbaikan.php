<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'perbaikan';
    protected $fillable = [
        'tgl_mulai',
        'tgl_selesai',
        'biaya',
        'id_barang',
        'keterangan',
        'foto',
        'jumlahBarang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
