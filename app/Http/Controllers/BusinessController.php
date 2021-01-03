<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Sector;
use App\Models\Community;
use App\Models\Business_category;
use App\Models\Business_owner;
use App\Models\Operation_days;
use Illuminate\Support\Str;
use Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BusinessImport;

class BusinessController extends Controller
{
    public function view()
    {
        // $owner = Business_owner::all();
        // $business = Business::orderBy('owner', 'asc')->get();
        return view('Backend.Business.index');
    }

    public function getBusinessDataServerSide()
    {

        $data = Business::query();
        return Datatables::eloquent($data)
            ->orderColumn('owner', function ($query, $order) {
                $query->orderBy('owner', 'asc');
            })
            ->addColumn('name', function ($data) {
                $name = '<td>'.$data->name.'</td>';
                return $name;
            })
            ->addColumn('loc_addr', function ($data) {
                $loc_addr = '<td>'.Str::limit($data->loc_address, 20).'</td>';
                return $loc_addr;
            })
            ->addColumn('community', function ($data) {
                if($data->community_id == null){
                    $community = '<td> - </td>';
                }else{
                    $community = '<td>'.$data->community->name.'</td>';
                }
                return $community;
            })
            ->addColumn('status', function ($data) {
                if($data->status === 'Verify'){
                    $status = '<td>'.$data->status.' &nbsp; <img src="'.asset('assets/img/icons/checked.png').'" class="img-fluid" alt="Responsive image" width="20"></td>';
                }else{
                    $status = '<td>'.$data->status.' &nbsp; <img src="'.asset('assets/img/icons/minus.png').'" class="img-fluid" alt="Responsive image" width="20"></td>';
                }
                return $status;
            })
            ->addColumn('details', function ($data) {
                $details = '<td><a class="btn btn-success btn-sm" href="'.url('/dapur').'/business/show/'.$data->id.'" role="button">View</a></td>';
                return $details;
            })
            ->addColumn('action', function ($data) {
                $action = '<td>
                                <a style="margin-right: 20px;" href="'.url('/dapur').'/business/edit/'.$data->id.'"><i class="fa fa-edit text-primary" style="font-size: 21px;"></i></a>
                                <a style="margin-right: 10px;" href="'.url('/dapur').'/business/delete/'.$data->id.'"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>
                            </td>';
                return $action;
            })->rawColumns(['name', 'owner','loc_addr', 'community', 'status', 'details', 'action'])
            ->make(true);
    }

    public function add()
    {
        $sector = Sector::all();
        $community = Community::all();
        $category = Business_category::all();
        $owner = Business_owner::all();
        return view('Backend.Business.create_business', ['sector' => $sector, 'community' => $community, 'category' => $category, 'owner' => $owner]);
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $owner = Business_owner::where('nik', $request->nik)->first();
        $photo = $request->file('photo');

        if ($photo == null) {
            $data = new Business;
            $data->business_owner_id = $owner->id;
            $data->owner = $request->owner;
            $data->name = $request->name;
            $data->loc_province = $request->loc_province;
            $data->loc_regency = $request->loc_regency;
            $data->loc_district = $request->loc_district;
            $data->loc_village = $request->loc_village;
            $data->loc_address = $request->loc_address;
            $data->contact = $request->contact;
            $data->photo = $photo;
            $data->status = $request->status;
            $data->is_active = $request->is_active;
            $data->business_sectors_id = $request->business_sectors_id;
            $data->business_category_id = $request->business_category_id;
            $data->community_id = $request->community_id;

            $process = $data->save();
            if ($process) {
                return redirect(url('/dapur/business'))->with('created', 'Success');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }else {

            $nama_file = time()."_".$photo->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'business_photo';
            $photo->move($tujuan_upload, $nama_file);

            $data = new Business;
            $data->business_owner_id = $owner->id;
            $data->owner = $request->owner;
            $data->name = $request->name;
            $data->loc_province = $request->loc_province;
            $data->loc_regency = $request->loc_regency;
            $data->loc_district = $request->loc_district;
            $data->loc_village = $request->loc_village;
            $data->loc_address = $request->loc_address;
            $data->contact = $request->contact;
            $data->photo = $nama_file;
            $data->status = $request->status;
            $data->is_active = $request->is_active;
            $data->business_sectors_id = $request->business_sectors_id;
            $data->business_category_id = $request->business_category_id;
            $data->community_id = $request->community_id;

            $process = $data->save();
            if ($process) {
                return redirect(url('/dapur/business'))->with('created', 'Success');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }

    }

    public function edit($id)
    {
        $business = Business::findOrFail($id);
        $sector = Sector::all();
        $community = Community::all();
        $category = Business_category::all();
        $owner = Business_owner::where('id', $business->business_owner_id)->first();
        return view('Backend.Business.edit', ['data' => $business, 'sector' => $sector, 'community' => $community, 'category' => $category, 'owner' => $owner ]);
    }

    public function update(Request $request, $id)
    {
        if($request->get('days') == null) {
            $owner = Business_owner::where('nik', $request->nik)->first();
            $photo = $request->file('photo');

            if ($photo == null) {
                $data = Business::findOrFail($id);
                $data->business_owner_id = $owner->id;
                $data->owner = $request->owner;
                $data->name = $request->name;
                $data->loc_province = $request->loc_province;
                $data->loc_regency = $request->loc_regency;
                $data->loc_district = $request->loc_district;
                $data->loc_village = $request->loc_village;
                $data->loc_address = $request->loc_address;
                $data->contact = $request->contact;
                $data->status = $request->status;
                $data->business_sectors_id = $request->business_sectors_id;
                $data->business_category_id = $request->business_category_id;
                $data->community_id = $request->community_id;

                $process = $data->save();
                if ($process) {
                    return redirect(url('/dapur/business/show/'.$id.''))->with('updated', 'Success');
                }else {
                    return back()->with('warning','Data Gagal Disimpan');
                }
            }else {

                $nama_file = time()."_".$photo->getClientOriginalName();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'business_photo';
                $photo->move($tujuan_upload, $nama_file);

                $data = Business::findOrFail($id);
                $data->business_owner_id = $owner->id;
                $data->owner = $request->owner;
                $data->name = $request->name;
                $data->loc_province = $request->loc_province;
                $data->loc_regency = $request->loc_regency;
                $data->loc_district = $request->loc_district;
                $data->loc_village = $request->loc_village;
                $data->loc_address = $request->loc_address;
                $data->contact = $request->contact;
                $data->photo = $nama_file;
                $data->status = $request->status;
                $data->business_sectors_id = $request->business_sectors_id;
                $data->business_category_id = $request->business_category_id;
                $data->community_id = $request->community_id;

                $process = $data->save();
                if ($process) {
                    return redirect(url('/dapur/business/show/'.$id.''))->with('updated', 'Success');
                }else {
                    return back()->with('warning','Data Gagal Disimpan');
                }
            }
        }else {
            $operation = Operation_days::where('business_id', $id)->first();
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

            $owner = Business_owner::where('nik', $request->nik)->first();
            $photo = $request->file('photo');

            if ($photo == null) {
                $data = Business::findOrFail($id);
                $data->business_owner_id = $owner->id;
                $data->owner = $request->owner;
                $data->name = $request->name;
                $data->loc_province = $request->loc_province;
                $data->loc_regency = $request->loc_regency;
                $data->loc_district = $request->loc_district;
                $data->loc_village = $request->loc_village;
                $data->loc_address = $request->loc_address;
                $data->contact = $request->contact;
                $data->status = $request->status;
                $data->business_sectors_id = $request->business_sectors_id;
                $data->business_category_id = $request->business_category_id;
                $data->community_id = $request->community_id;

                $process = $data->save();
                if ($process) {
                    return redirect(url('/dapur/business/show/'.$id.''))->with('updated', 'Success');
                }else {
                    return back()->with('warning','Data Gagal Disimpan');
                }
            }else {

                $nama_file = time()."_".$photo->getClientOriginalName();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'business_photo';
                $photo->move($tujuan_upload, $nama_file);

                $data = Business::findOrFail($id);
                $data->business_owner_id = $owner->id;
                $data->owner = $request->owner;
                $data->name = $request->name;
                $data->loc_province = $request->loc_province;
                $data->loc_regency = $request->loc_regency;
                $data->loc_district = $request->loc_district;
                $data->loc_village = $request->loc_village;
                $data->loc_address = $request->loc_address;
                $data->contact = $request->contact;
                $data->photo = $nama_file;
                $data->status = $request->status;
                $data->business_sectors_id = $request->business_sectors_id;
                $data->business_category_id = $request->business_category_id;
                $data->community_id = $request->community_id;

                $process = $data->save();
                if ($process) {
                    return redirect(url('/dapur/business/show/'.$id.''))->with('updated', 'Success');
                }else {
                    return back()->with('warning','Data Gagal Disimpan');
                }
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
        $business = Business::where('id', $id)->first();
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

    public function qrcode($id)
    {
        $collection = Str::of($id)->explode(',');
        $business = Business::find($collection);

        return view('Backend.Business.qrcode', ['business' => $business]);
    }

    public function import()
    { 
        $owner_max_id = Business_owner::all()->max('id');
        $owner_available_id = $owner_max_id + 5;

        $business_max_id = Business::all()->max('id');
        $business_available_id = $business_max_id + 5;

        return view('Backend.Business.import', ['ownermax' => $owner_available_id, 'businessmax' => $business_available_id]);
    }

    public function fileImport(Request $request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
        $file = $request->file('file');

		// membuat nama file unik
		$nama_file = time()."_".$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('import_file', $nama_file);

		// import data
        Excel::import(new BusinessImport, public_path('/import_file/'.$nama_file));

		// alihkan halaman kembali
		return back()->with('created', 'Berhasil');
    }

}
