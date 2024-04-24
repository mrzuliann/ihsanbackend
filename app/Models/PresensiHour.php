<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiHour extends Model
{
    use HasFactory;
    protected $table = 'presensis_hour';
    protected $fillable = [
        'id',
        'ph_name',
        'ph_desc',
        'ph_time_start',
        'ph_time_end',
        'ah_status',
        'created_at',
        'updated_at'
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id', 'ph_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

}
