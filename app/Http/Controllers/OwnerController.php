<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business_owner;
use Illuminate\Support\Str;
use App\Models\Community;
use App\Models\Business;
use App\Models\Operation_days;
use DataTables;

class OwnerController extends Controller
{
    public function getOwnerDataServerSide()
    {
       
        $data = Business_owner::query();
        return Datatables::eloquent($data)
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('created_at', 'desc');
            })
            ->addColumn('checkbox', function ($data) {
                $checkbox = '<td style="text-align: center;"><input type="checkbox" aria-label="Checkbox for following text input" id="cekbox'.$data->id.'" name="cek[]" value="'.$data->id.'"></td>' ;
                return $checkbox;
            })
            ->addColumn('nik', function ($data) {
                $nik = '<td>'.$data->nik.'</td>';
                return $nik;
            })
            ->addColumn('ktp_addr', function ($data) {
                $ktp_addr = '<td>'.Str::limit($data->ktp_address, 35).'</td>';
                return $ktp_addr;
            })
            ->addColumn('dom_addr', function ($data) {
                $dom_addr = '<td>'.Str::limit($data->domisili_address, 35).'</td>';
                return $dom_addr;
            })
            ->addColumn('prokes', function ($data) {
                if($data->attachment == null){
                    $prokes = '<td><i class="fa fa-times-circle text-danger" style="font-size: 21px;"></i></td>';
                }else{
                    $prokes = '<td><a href="'.url('/agreement_file').'/'.$data->attachment.'" target="_blank"><i class="fa fa-check-circle text-success" style="font-size: 21px;"></i></a></td>';
                }
                return $prokes;
            })
            ->addColumn('details', function ($data) {
                $details = '<td><a class="btn btn-success btn-sm" href="'.url()->current().'/owner/show/'.$data->id.'" role="button">View</a></td>';
                return $details;
            })
            ->addColumn('action', function ($data) {
                $action = '<td>
                                <a style="margin-right: 20px;" href="'.url()->current().'/owner/edit/'.$data->id.'"><i class="fa fa-edit text-primary" style="font-size: 21px;"></i></a>
                                <a style="margin-right: 10px;" href="'.url()->current().'/owner/delete/'.$data->id.'"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>
                            </td>';
                return $action;
            })->rawColumns(['checkbox','name','nik','ktp_addr', 'dom_addr', 'prokes', 'details', 'action'])
            ->make(true);
    }


    public function add()
    {
        $community = Community::all();
        return view('Backend.Business.create_owner', ['data' => $community]);
    }

    public function create(Request $request)
    {
        // dd($request->all());

        $attachment = $request->file('attachment');

        if ($attachment == null) {
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
        }else {
            $nama_file = time()."_".$attachment->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'agreement_file';
            $attachment->move($tujuan_upload, $nama_file);

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

            $data->attachment = $nama_file;

            $process = $data->save();
            if ($process) {
                return redirect(url('/dapur/business'))->with('owner_created', 'Berhasil');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }
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

        // dd($request->all());

        $attachment = $request->file('attachment');
        $photo = $request->file('photo');

        if (($attachment == null) && ($photo == null))
        {
            $owner->name = $request->name;
            $owner->nik = $request->nik;

            $owner->ktp_loc_province = $request->ktp_loc_province;
            $owner->ktp_loc_regency = $request->ktp_loc_regency;
            $owner->ktp_loc_district = $request->ktp_loc_district;
            $owner->ktp_loc_village = $request->ktp_loc_village;
            $owner->ktp_address = $request->ktp_address;

            $owner->domisili_loc_province = $request->domisili_loc_province;
            $owner->domisili_loc_regency = $request->domisili_loc_regency;
            $owner->domisili_loc_district = $request->domisili_loc_district;
            $owner->domisili_loc_village = $request->domisili_loc_village;
            $owner->domisili_address = $request->domisili_address;

            $process = $owner->save();
            if ($process) {
                return redirect(url('/dapur/business/owner/show/'.$id.''))->with('owner_created', 'Berhasil');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }

        if(($attachment == null) && (isset($photo)))
        {
            $nama_file = time()."_".$photo->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'profile_pictures';
            $photo->move($tujuan_upload, $nama_file);

            $owner->name = $request->name;
            $owner->nik = $request->nik;

            $owner->ktp_loc_province = $request->ktp_loc_province;
            $owner->ktp_loc_regency = $request->ktp_loc_regency;
            $owner->ktp_loc_district = $request->ktp_loc_district;
            $owner->ktp_loc_village = $request->ktp_loc_village;
            $owner->ktp_address = $request->ktp_address;

            $owner->domisili_loc_province = $request->domisili_loc_province;
            $owner->domisili_loc_regency = $request->domisili_loc_regency;
            $owner->domisili_loc_district = $request->domisili_loc_district;
            $owner->domisili_loc_village = $request->domisili_loc_village;
            $owner->domisili_address = $request->domisili_address;

            $owner->photo = $nama_file;

            $process = $owner->save();
            if ($process) {
                return redirect(url('/dapur/business/owner/show/'.$id.''))->with('owner_created', 'Berhasil');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }

        }
        if (($photo == null) && (isset($attachment))) {

            $nama_file = time()."_".$attachment->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'agreement_file';
            $attachment->move($tujuan_upload, $nama_file);

            $owner->name = $request->name;
            $owner->nik = $request->nik;

            $owner->ktp_loc_province = $request->ktp_loc_province;
            $owner->ktp_loc_regency = $request->ktp_loc_regency;
            $owner->ktp_loc_district = $request->ktp_loc_district;
            $owner->ktp_loc_village = $request->ktp_loc_village;
            $owner->ktp_address = $request->ktp_address;

            $owner->domisili_loc_province = $request->domisili_loc_province;
            $owner->domisili_loc_regency = $request->domisili_loc_regency;
            $owner->domisili_loc_district = $request->domisili_loc_district;
            $owner->domisili_loc_village = $request->domisili_loc_village;
            $owner->domisili_address = $request->domisili_address;

            $owner->attachment = $nama_file;

            $process = $owner->save();
            if ($process) {
                return redirect(url('/dapur/business/owner/show/'.$id.''))->with('owner_created', 'Berhasil');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }
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
