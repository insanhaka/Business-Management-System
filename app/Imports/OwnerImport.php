<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Business_owner;

class OwnerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row['name']);
        return new Business_owner([
            'id' => $row['id'],
            'name' => $row['nama'],
            // 'user_id' => $row['user_id'],
            'nik' => $row['nik'],
            'gender' => $row['jenis_kelamin'],
            'domisili_loc_province' => $row['domisili_provinsi'],
            'domisili_loc_regency' => $row['domisili_kab_kota'],
            'domisili_loc_district' => $row['domisili_kec'],
            'domisili_loc_village' => $row['domisili_desa'],
            'domisili_address' => $row['alamat_domisili_lengkap'],
            'ktp_loc_province' => $row['ktp_provinsi'],
            'ktp_loc_regency' => $row['ktp_kab_kota'],
            'ktp_loc_district' => $row['ktp_kec'],
            'ktp_loc_village' => $row['ktp_desa'],
            'ktp_address' => $row['alamat_ktp_lengkap'],
            // 'photo' => $row['photo'],
            // 'attachment' => $row['attachment'],
            // 'created_by' => $row['created_by'],
        ]);
    }
}
