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
        'request_date',
        'request_date_end',
        'id_status',
        'tgl_pengembalian',
        'note',
        'new_item',
        'id_kategori',
        'level',
        'id_lokasi',
        'id_type'
    ];
    protected $casts = [
        'created_at' => 'datetime', // Assuming 'created_at' is the timestamp field
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
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type');
    }
}
