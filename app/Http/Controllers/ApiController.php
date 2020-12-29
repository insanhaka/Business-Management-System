<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business_owner;
use App\Models\Business;
use App\Models\Product_category;
use App\Models\Product;
use App\Models\Product_photo;
use App\Models\Report;
use DB;

class ApiController extends Controller
{

    public function datauser()
    {
        $user = User::all();
        return response()->json([
            'message' => 'success',
            'data' => $user
        ]);
    }

    public function databusiness()
    {
        $business = Business::all();
        return response()->json([
            'message' => 'success',
            'data' => $business
        ]);
    }

    public function dataowner()
    {
        $owner = Business_owner::all();
        return response()->json([
            'message' => 'success',
            'data' => $owner
        ]);
    }

    public function dataproductcategory()
    {
        $product_category = Product_category::all();
        return response()->json([
            'message' => 'success',
            'data' => $product_category
        ]);
    }

    public function dataproduct()
    {
        $product = Product::all();
        return response()->json([
            'message' => 'success',
            'data' => $product
        ]);
    }

    public function dataphotoproduct()
    {
        $photo_product = Product_photo::all();
        return response()->json([
            'message' => 'success',
            'data' => $photo_product
        ]);
    }

    public function datareport()
    {
        $report = Report::all();
        return response()->json([
            'message' => 'success',
            'data' => $report
        ]);
    }

    public function datareportcustome()
    {
        $cek_data_sangatburuk = Report::where('rating', 1)->count();
        $cek_data_sangatbaik = Report::where('rating', 5)->count();
        $cek_data_report = Report::all()->count();

        $data_sangatbaik = Report::where('rating', 5)->orderBy('count', 'desc')->select(DB::raw('business_id, count(*) as count'))->groupBy('business_id')->get()->take(5);

        $data_sangatburuk = Report::where('rating', 1)->orderBy('count', 'desc')->select(DB::raw('business_id, count(*) as count'))->groupBy('business_id')->get()->take(5);

        $report = Report::all()->sortByDesc('created_at')->take(5);

        $business = Business::all();

        if ($cek_data_sangatbaik > 0) {
            foreach($data_sangatbaik as $item)
            {
                foreach($business as $usaha)
                {
                    if ($item->business_id == $usaha->id) {
                        $dataterbaik[] = [
                            'id' => $usaha->id,
                            'Nama Usaha' => $usaha->name,
                            'Pemilik' => $usaha->owner,
                            'Jumlah' => $item->count,
                        ];
                    }
                }
            }
        }else {
            $dataterbaik = "kosong";
        }

        if ($cek_data_sangatburuk > 0) {
            foreach($data_sangatburuk as $item)
            {
                foreach($business as $usaha)
                {
                    if ($item->business_id == $usaha->id) {
                        $dataterburuk[] = [
                            'id' => $usaha->id,
                            'Nama Usaha' => $usaha->name,
                            'Pemilik' => $usaha->owner,
                            'Jumlah' => $item->count,
                        ];
                    }
                }
            }
        }else {
            $dataterburuk = "kosong";
        }

        if ($cek_data_report > 0) {
            foreach($report as $item)
            {
                foreach($business as $usaha)
                {
                    if ($item->business_id == $usaha->id) {
                        $datareport[] = [
                            'id' => $usaha->id,
                            'Nama Usaha' => $usaha->name,
                            'Pemilik' => $usaha->owner,
                            'Nilai' => $item->grade,
                        ];
                    }
                }
            }
        }else {
            $datareport = "kosong";
        }

        return response()->json([
            'message' => 'success',
            'dataterbaik' => $dataterbaik,
            'dataterburuk' => $dataterburuk,
            'datareport' => $datareport
        ]);
    }

    public function gradereport()
    {
        $data_sangatburuk = Report::where('rating', 1)->count();
        $data_buruk = Report::where('rating', 2)->count();
        $data_cukupbaik = Report::where('rating', 3)->count();
        $data_baik = Report::where('rating', 4)->count();
        $data_sangatbaik = Report::where('rating', 5)->count();

        $value = array($data_sangatburuk, $data_buruk, $data_cukupbaik, $data_baik, $data_sangatbaik);

        return response()->json([
            'message' => 'success',
            'data' => $value,
        ]);
    }

    public function prokesagree()
    {
        $data_owner = Business_owner::all()->count();
        $data_belum = Business_owner::where('attachment', null)->count();

        $data_sudah = $data_owner - $data_belum;

        $value = array($data_sudah, $data_belum);

        return response()->json([
            'message' => 'success',
            'data' => $value,
        ]);
    }

    public function sellerregister(Request $request)
    {
        // dd($request->username);

        $signup = new User;
        $signup->name = $request->name;
        $signup->username = $request->username;
        $signup->email = $request->email;
        $signup->password = bcrypt($request->password);
        $signup->status = "seller";

        $signup->save();
    }

}
