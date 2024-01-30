<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Karyawan;

class Presensi extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'presensi_status',
        'id_karyawan',
        'nama_lengkap'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Define the nama_lengkap attribute
    public function getNamaLengkapAttribute()
    {
        return $this->karyawan->nama_lengkap;
    }

    // Append the nama_lengkap attribute to the JSON representation of the model
    protected $appends = ['nama_lengkap'];
}
