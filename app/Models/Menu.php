<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded =['id_menu'];
    protected $table = 'menu';
    public function meja(){
        return $this->hasMany(Pemesanan::class, 'id_meja');
    }
}
