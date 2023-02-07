<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'lokasi';
    protected $fillable = ['lokasi', 'id_area'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}
