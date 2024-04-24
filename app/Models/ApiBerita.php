<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiBerita extends Model
{
    use HasFactory;
    protected $connection = 'kabblg_mcbalangan';

    protected $fillable = [
        'judul',
        'lead',
        'content',
        'tanggal',
        'gambar',
        'ditulis',
        'slug_berita',
    ];
}
