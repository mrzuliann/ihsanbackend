<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;
    protected $table = 'presensis_pengajuancuti';
    protected $primaryKey = 'pengajuan_id';
    // protected $foreignKey = 'school_id';
    protected $fillable = [
        'pegawai',
        'tanggal_awal',
        'tanggal_akhir',
        'status',
        'lampiran',
        'created_at',
        'updated_at',
    ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id','name'); // 'pegawai' adalah foreign key pada table 'presensis_pengajuancuti'
    // }
    public function user()
{
    return $this->belongsTo(User::class, 'pegawai', 'id');
}


}
