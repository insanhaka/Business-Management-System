<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Sector;
use App\Models\Community;
use App\Models\Business_category;
use App\Models\Business_picture;
use App\Models\Business_owner;
use App\Models\Operation_days;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function view()
    {
        $owner = Business_owner::all();
        return view('Backend.Business.index', ['owner' => $owner]);
    }

    public function add()
    {
        $sector = Sector::all();
        $community = Community::all();
        $category = Business_category::all();
        return view('Backend.Business.create_business', ['sector' => $sector, 'community' => $community, 'category' => $category]);
    }

    public function create(Request $request)
    {
        dd($request->all());
        
        $data = new Business;
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

    public function edit($id)
    {
        $business = Business::findOrFail($id);
        $sector = Sector::all();
        return view('Backend.Business.edit', ['data' => $business, 'sectors' => $sector ]);
    }

    public function update(Request $request, $id)
    {
        $operation = Operation_days::where('business_id', $id)->get();
        if ($operation == null) {

            if(in_array('senin', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Senin',
                    'open' => $request->senopen,
                    'close' => $request->senclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('selasa', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Selasa',
                    'open' => $request->selopen,
                    'close' => $request->selclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('rabu', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Rabu',
                    'open' => $request->rabopen,
                    'close' => $request->rabclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('kamis', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Kamis',
                    'open' => $request->kamopen,
                    'close' => $request->kamclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('jumat', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Jumat',
                    'open' => $request->jumopen,
                    'close' => $request->jumclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('sabtu', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Sabtu',
                    'open' => $request->sabopen,
                    'close' => $request->sabclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('minggu', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Minggu',
                    'open' => $request->mingopen,
                    'close' => $request->mingclose,
                    'business_id' => $id,
                ]);
            }
        }else {

            Operation_days::where('business_id', $id)->delete();
            if(in_array('senin', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Senin',
                    'open' => $request->senopen,
                    'close' => $request->senclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('selasa', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Selasa',
                    'open' => $request->selopen,
                    'close' => $request->selclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('rabu', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Rabu',
                    'open' => $request->rabopen,
                    'close' => $request->rabclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('kamis', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Kamis',
                    'open' => $request->kamopen,
                    'close' => $request->kamclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('jumat', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Jumat',
                    'open' => $request->jumopen,
                    'close' => $request->jumclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('sabtu', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Sabtu',
                    'open' => $request->sabopen,
                    'close' => $request->sabclose,
                    'business_id' => $id,
                ]);
            }
            if(in_array('minggu', $request->get('days'))){
                Operation_days::create([
                    'days' => 'Minggu',
                    'open' => $request->mingopen,
                    'close' => $request->mingclose,
                    'business_id' => $id,
                ]);
            }
        }

        $files = $request->file('gambar');

        $business = Business::findOrFail($id);
        $business->name = $request->name;
        $business->loc_province = $request->loc_province;
        $business->loc_regency = $request->loc_regency;
        $business->loc_district = $request->loc_district;
        $business->loc_village = $request->loc_village;
        $business->address = $request->address;
        $business->owner = $request->owner;
        $business->contact = $request->contact;
        $business->business_sectors_id = $request->business_sectors_id;
        $business_update = $business->save();

        if ($files == null) {
            if ($business_update) {
                return redirect(url('/dapur/business'))->with('updated','Data Berhasil Disimpan');
            } else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }else{
            $pict = Business_picture::where('business_id', $id)->get();
            if ($pict == null) {
                foreach ($files as $value) {
                    $nama_file = time()."_".$value->getClientOriginalName();
                    $tujuan_upload = 'business_pictures';
                    $value->move($tujuan_upload,$nama_file);
                    $pict_proses = Business_picture::create([
                        'title' => $nama_file,
                        'business_id' => $id
                    ]);
                }
            }else{
                Business_picture::where('business_id', $id)->delete();
                foreach ($files as $value) {
                    $nama_file = time()."_".$value->getClientOriginalName();
                    $tujuan_upload = 'business_pictures';
                    $value->move($tujuan_upload,$nama_file);
                    $pict_proses = Business_picture::create([
                        'title' => $nama_file,
                        'business_id' => $id
                    ]);
                }
            }

            if ($business_update && $pict_proses) {
                return redirect(url('/dapur/business'))->with('updated','Data Berhasil Disimpan');
            } else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }

    }

    public function delete($id)
    {
        $business = Business::find($id);
        $process = $business->delete();

        if ($process) {
            return redirect(url('/dapur/business'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }

    public function show($id)
    {
        $business = Business::findOrFail($id);
        $operation = Operation_days::where('business_id', $id)->get();
        return view('Backend.Business.show', ['business' => $business, 'operation' => $operation ]);
    }

    public function activation(Request $request)
    {
        $id = $request->id;
        // dd($id);

        $business = Business::findOrFail($id);
        $business->is_active = $request->is_active;

        $process = $business->save();
    }
}
