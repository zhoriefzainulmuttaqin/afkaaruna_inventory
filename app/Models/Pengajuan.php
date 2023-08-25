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
        'id_area',
        'jumlahBarang',
        'required_date',
        'id_status',
        'tgl_pengembalian',
        'note',

    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}
