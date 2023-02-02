<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'barang';
    protected $fillable = [
        'nama',
        'code',
        'tgl_masuk',
        'kepemilikan',
        'foto',
        'keterangan',
        'id_lokasi',
        'id_kategori',
        'id_status'
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
