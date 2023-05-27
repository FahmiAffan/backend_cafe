<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id_pemesanan'];
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    
    public function detailPemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan');
    }
    public function detailMeja()
    {
        return $this->hasOne(Meja::class, 'id_meja');
    }
}
