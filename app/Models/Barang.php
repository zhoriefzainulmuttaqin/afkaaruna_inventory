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
        'id_status',
        'stock',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
