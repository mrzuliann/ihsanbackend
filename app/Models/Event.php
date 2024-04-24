<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'presensis_event';
 protected $primaryKey = 'event_id';
    protected $fillable = [
        'event_id',
        'school_id',
        'ph_id',
        'event_name',
        'event_desc',
        'event_image',
        'event_radius',
        'event_location_name',
        'event_lat',
        'event_lng',
        'event_date',
        'event_start_time',
        'event_end_time',
        'event_rutin',
        'event_created_by',
        'event_tipe_peserta',
        'event_create_at',
        'updated_at',
        'deleted_at',
    ];
}
