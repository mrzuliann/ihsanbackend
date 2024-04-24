<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiHourDay extends Model
{
    use HasFactory;
    protected $table = 'presensis_hour_day';
    protected $primaryKey = 'phd_id';
    protected $fillable = [
        'phd_id',
        'ph_id',
        'school_id',
        'shift_id',
        'ph_day',
        'ph_time_start',
        'ph_time_end',
        'created_at',
        'updated_at',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'shift_id');
    }

    public function presensihour()
    {
        return $this->belongsTo(PresensiHour::class, 'ph_id', 'id');
    }
}
