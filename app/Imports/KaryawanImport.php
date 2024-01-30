<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;

class KaryawanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Karyawan([
            'nama_lengkap' => $row[1],
            'nomor_induk_karyawan' => $row[2],
            'alamat' => $row[3],
            'cabang' => $row[4],
            'organisasi' => $row[5],
            'jabatan' => $row[6],
            'level_jabatan' => $row[7],
            'id_user' => $row[8],
        ]);
    }
}
