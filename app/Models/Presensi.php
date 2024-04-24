<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'latitude',
        'longitude',
        'tanggal',
        'masuk',
        'pulang',
        'ph_id',
        'ps_id',
        'created_at',
        'updated_at'
    ];

    public function presensihour()
    {
        return $this->belongsTo(PresensiHour::class, 'ph_id', 'id');
    }

    public function presensistatus()
    {
        return $this->belongsTo(PresensiStatus::class, 'ps_id', 'as_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presensiDetail()
    {
        return $this->hasMany('App\Models\PresensiDetail', 'pd_id')
            ->join('abs_absen_status', 'abs_absen_detail.as_id', 'abs_absen_status.as_id');
    }
}
