<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap',
        'nomor_induk_karyawan',
        'alamat',
        'cabang',
        'organisasi',
        'jabatan',
        'level_jabatan',
        'id_user',
    ];
}
