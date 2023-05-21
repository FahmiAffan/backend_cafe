<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pemesanan',
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
}
