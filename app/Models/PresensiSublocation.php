<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiSublocation extends Model
{
    use HasFactory;
    protected $table = 'presensis_subloction';
    protected $primaryKey = 'loc_id';
    protected $fillable = [
        'loc_id',
        'school_id',
        'submit_id',
        'loc_name',
        'loc_lat',
        'loc_lng',
        'loc_radius',
        'created_at',
        'updated_at',
    ];
}
