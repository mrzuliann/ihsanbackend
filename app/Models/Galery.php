<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;
    protected $table = 'galery';
    protected $fillable = [
        'id',
        'title',
        'description',
        'author',
        'image',
        'created_at',
        'updated_at',
    ];
}
