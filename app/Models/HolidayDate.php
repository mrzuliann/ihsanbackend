<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayDate extends Model
{
    use HasFactory;
    protected $table = 'presensis_holiday';
    protected $fillable = [
        'holiday_id',
        'holiday_name',
        'holiday_desc',
        'holiday_date',
        'holiday_day',
        'holiday_type',
        'holiday_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
