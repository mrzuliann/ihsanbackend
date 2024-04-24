<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    // protected $foreignKey = 'school_id';
    protected $fillable = [
        'id',
        'name',
        'status',
        'desc',
        'image_file',
        'tipe_peserta',
        'created_at',
        'updated_at',
    ];
}
