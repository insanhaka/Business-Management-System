<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business_owner;
use Illuminate\Support\Str;
use App\Models\Community;
use App\Models\Business;
use App\Models\Operation_days;

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

    public function edit($id)
    {
        $owner = Business_owner::findOrFail($id);
        return view('Backend.Business.edit_owner', ['data' => $owner]);
    }

    public function update(Request $request, $id)
    {
        $owner = Business_owner::findOrFail($id);
        $process = $owner->update($request->all());

        if ($process) {
            return redirect(url('/dapur/business'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $owner = Business_owner::find($id);
        $process = $owner->delete();

        if ($process) {
            return redirect(url('/dapur/business'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }

    public function show($id)
    {
        $owner = Business_owner::findOrFail($id);
        $data_check = Business::where('business_owner_id', $id)->first();

        if ($data_check == null) {
            return back()->with('empty','Data Kosong');
        } else {
            $business = Business::where('business_owner_id', $id)->get();
            return view('Backend.Business.show_owner', ['business' => $business, 'owner' => $owner ]);
        }

    }
}
