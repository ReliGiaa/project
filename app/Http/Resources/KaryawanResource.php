<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanResource extends JsonResource
{
    
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array 
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id, 
            'nama_lengkap'          => $this->nama_lengkap,
            'nomor_induk_karyawan'  => $this->nomor_induk_karyawan,
            'alamat'                => $this->alamat,
            'cabang'                => $this->cabang,
            'organisasi'            => $this->organisasi,
            'jabatan'               => $this->jabatan,
            'level_jabatan'         => $this->level_jabatan,
            'id_user'               => $this->id_user,
            'datakaryawan'          => $this->resource,
        ];
    }
}
