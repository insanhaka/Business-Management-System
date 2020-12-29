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
            'name' => $row['name'],
            'user_id' => $row['user_id'],
            'nik' => $row['nik'],
            'gender' => $row['gender'],
            'domisili_loc_province' => $row['domisili_loc_province'],
            'domisili_loc_regency' => $row['domisili_loc_regency'],
            'domisili_loc_district' => $row['domisili_loc_district'],
            'domisili_loc_village' => $row['domisili_loc_village'],
            'domisili_address' => $row['domisili_address'],
            'ktp_loc_province' => $row['ktp_loc_province'],
            'ktp_loc_regency' => $row['ktp_loc_regency'],
            'ktp_loc_district' => $row['ktp_loc_district'],
            'ktp_loc_village' => $row['ktp_loc_village'],
            'ktp_address' => $row['ktp_address'],
            'photo' => $row['photo'],
            'attachment' => $row['attachment'],
            'created_by' => $row['created_by'],
        ]);
    }
}
