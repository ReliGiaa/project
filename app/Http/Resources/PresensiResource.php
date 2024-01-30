<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PresensiResource extends JsonResource
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
            'id'                => $this->id,
            'tanggal'           => $this->tanggal,
            'jam_masuk'         => $this->jam_masuk,
            'jam_pulang'        => $this->jam_pulang,
            'presensi_status'   => $this->presensi_status,
            'id_karyawan'       => $this->id_karyawan,
            'nama_lengkap'      => $this->nama_lengkap,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'datapresensi'      => $this->resource,
        ];
    }

}
