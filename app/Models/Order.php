<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id_orders";
    protected $fillable = [
        "id_cust",
        "id_product",
        "jumlah_pembelian",
        "status_pesanan"
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_cust');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
