<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business_owner;
use Illuminate\Support\Str;

class OwnerController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        $data = new Business_owner;
        $data->name = $request->name;
        $data->loc_province = $request->loc_province;
        $data->loc_regency = $request->loc_regency;
        $data->loc_district = $request->loc_district;
        $data->loc_village = $request->loc_village;
        $data->address = $request->address;
        $data->owner = $request->owner;
        $data->contact = $request->contact;
        $data->business_sectors_id = $request->business_sectors_id;

        $business_name = $request->name;

        $process = $data->save();
        if ($process) {
            return redirect(url('/dapur/business'))->with('created', $business_name);
        }else {
            return back()->with('warning','Data Gagal Disimpan');
        }

    }
}
