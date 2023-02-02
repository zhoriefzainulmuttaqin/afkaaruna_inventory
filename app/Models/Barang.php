<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['nama', 'code', 'tgl_masuk', 'kepemilikan', 'foto', 'keterangan', 'id_lokasi', 'id_kategori', 'id_status'];
}
