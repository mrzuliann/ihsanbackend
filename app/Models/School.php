<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'latitude',
        'longitude',
        'radius',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','school_id','name');
        // return $this->hasMany('App\Models\User', 'sekolah_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    public function presensihourday()
    {
        return $this->hasMany(PresensiHourDay::class);
    }
}
