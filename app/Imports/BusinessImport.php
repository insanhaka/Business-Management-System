<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Business;

class BusinessImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Business([
            'id' => $row['id'],
            'business_owner_id' => $row['id_pemilik_usaha'],
            'owner' => $row['nama_pemilik'],
            'name' => $row['nama_usaha'],
            'loc_province' => $row['lokasi_prov'],
            'loc_regency' => $row['lokasi_kab'],
            'loc_district' => $row['lokasi_kec'],
            'loc_village' => $row['lokasi_desa'],
            'loc_address' => $row['detail_lokasi'],
            'contact' => $row['no_hp'],
            'status' => $row['status'],
            'is_active' => $row['is_active'],
            'business_sectors_id' => $row['id_sektor_bisnis'],
            'community_id' => $row['id_paguyuban'],
        ]);
    }
}
