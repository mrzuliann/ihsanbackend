<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiDetail extends Model
{
    use HasFactory;
    protected $table = 'presensis_detail';
    protected $primaryKey = 'pd_id';
    protected $fillable = [
        'pd_id',
        'ps_id',
        'ph_id',
        'presensi_id',
        'checkin_id',
        'loc_id',
        'pd_time',
        'pd_file',
        'pd_desc',
        'holiday_desc',
        'pd_lat',
        'pd_lng',
        'pd_is_late',
        'pd_late_length',
        'pd_potongan_tpp',
        'pd_is_holiday',
        'created_at',
        'updated_at'
    ];

    public function presensi()
    {
        return $this->belongsTo(Presensi::class, 'presensi_id', 'id');
    }
}
