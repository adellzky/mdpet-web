<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'category',
        'stok',
        'price',
        'deskripsi',
        'image',
    ];

    public static function groomingStok()
    {
        return self::where('category', 'grooming')->sum('stok');
    }

    public static function vaksinStok()
    {
        return self::where('category', 'vaksin')->sum('stok');
    }

}
