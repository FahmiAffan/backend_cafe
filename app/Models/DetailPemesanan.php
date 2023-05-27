<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pemesanan',
        'id_meja',
        'id_menu',
        'jumlah_pemesanan',
        'total_harga',
    ];
    protected $guarded = ['id_detail_pemesanan'];
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_detail_pemesanan';

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
    public function detailMenu()
    {
        return $this->hasOne(Menu::class, 'id_menu');
    }
}
