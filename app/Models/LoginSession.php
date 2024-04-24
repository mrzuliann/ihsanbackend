<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginSession extends Model
{
    use HasFactory;
    protected $table = 'presensis_login_session';
    protected $primaryKey = 'ls_id';
    // protected $foreignKey = 'school_id';
    protected $fillable = [
        'ls_id',
        'app_id',
        'user_id',
        'ls_key',
        'ls_firebase_reg_id',
        'ls_device_version',
        'ls_device',
        'ls_os_version',
        'ls_carrier',
        'ls_channel',
        'created_at',
        'updated_at',
    ];
}
