<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business_owner;
use Illuminate\Support\Str;
use App\Models\Community;

class OwnerController extends Controller
{

    public function add()
    {
        $community = Community::all();
        return view('Backend.Business.create_owner', ['data' => $community]);
    }

    public function create(Request $request)
    {
        // dd($request->all());

        $data = new Business_owner;
        $data->name = $request->name;
        $data->nik = $request->nik;

        $data->ktp_loc_province = $request->ktp_loc_province;
        $data->ktp_loc_regency = $request->ktp_loc_regency;
        $data->ktp_loc_district = $request->ktp_loc_district;
        $data->ktp_loc_village = $request->ktp_loc_village;
        $data->ktp_address = $request->ktp_address;

        $data->domisili_loc_province = $request->domisili_loc_province;
        $data->domisili_loc_regency = $request->domisili_loc_regency;
        $data->domisili_loc_district = $request->domisili_loc_district;
        $data->domisili_loc_village = $request->domisili_loc_village;
        $data->domisili_address = $request->domisili_address;

        $process = $data->save();
        if ($process) {
            return redirect(url('/dapur/business'))->with('owner_created', 'Berhasil');
        }else {
            return back()->with('warning','Data Gagal Disimpan');
        }

    }
}
