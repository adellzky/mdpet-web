<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'item';
    protected $primaryKey = 'id_item';
    protected $fillable = [
        'nama_produk',
        'stok',
        'harga',
        'deskripsi',
        'image',
    ];

    // public function item()
    // {
    //     return $this->hasMany(admin::class, '');
    // }
}
