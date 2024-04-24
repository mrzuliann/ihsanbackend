<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'presensis_shift';
    protected $primaryKey = 'shift_id';

    protected $fillable = [
        'shift_id',
        'school_id',
        'shift_name',
        'created_at',
        'updated_at',
    ];
    // public function school()
    // {
    //     return $this->belongsTo(School::class);
    // }
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
