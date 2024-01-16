<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Grooming extends Model
{


    protected $table = 'grooming';
    protected $primaryKey = 'id_grooming';

    protected $fillable = [
        'jenis_hewan',
        'nama_hewan',
        'tanggal_pemesanan',
        'biaya'
    ];
}
//     public function customer()
//     {
//         return $this->belongsTo(Customer::class, 'id_grooming', 'id_cust');
//     }
//
