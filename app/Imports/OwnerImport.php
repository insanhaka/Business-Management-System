<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Business_owner;

class OwnerImport implements ToModel
{
    public function model(array $row)
    {
        return new Business_owner([
            'id' => $row[0],
            'name' => $row[1],
            'nik' => $row[2],
            'domisili_loc_province' => $row[3],
            'domisili_loc_regency' => $row[4],
            'domisili_loc_district' => $row[5],
            'domisili_loc_village' => $row[6],
            'domisili_address' => $row[7],
            'ktp_loc_province' => $row[8],
            'ktp_loc_regency' => $row[9],
            'ktp_loc_district' => $row[10],
            'ktp_loc_village' => $row[11],
            'ktp_address' => $row[12],
        ]);
    }
}
