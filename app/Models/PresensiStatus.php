<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiStatus extends Model
{
    use HasFactory;
    protected $table = 'presensis_status';
    protected $fillable = [
        'as_id',
        'as_name',
        'as_alias',
        'as_percent',
        'as_color',
        'as_color2',
        'as_color3',
        'created_at',
        'updated_at',
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id', 'ps_id');
    }
    // public function getUser($user)
    // {
    //     $user = 
    // }
}
