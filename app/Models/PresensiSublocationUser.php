<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSublocationUser extends Model
{
    use HasFactory;
    protected $table = 'presensis_subloction_persuser';
    protected $primaryKey = 'lu_id';
    protected $fillable = [
        'user_id',
        'loc_name',
        'loc_lat',
        'loc_lng',
        'loc_radius',
        'created_at',
        'updated_at',
    ];
}
