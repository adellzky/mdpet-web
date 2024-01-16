<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "post";
    protected $fillable = ['title', 'deskripsi', 'image', 'id_user'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
