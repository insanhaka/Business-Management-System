<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\rating;
use App\Models\Report;
use DB;
use Carbon\Carbon;

class FrontQRCodeController extends Controller
{
    public function index($id)
    {
        $business = Business::find($id);

        $ratings = Rating::where('business_id', $id)->get();
        $ratings_submiter = Rating::where('business_id', $id)->count();

        if($ratings_submiter == 0){
            $ratings_average = 0;
            $final_rating = number_format($ratings_average, 1, '.', '');
        }else {
            foreach ($ratings as $rating) {
                $rating_data[] = $rating->rate_value;
            }
            $ratings_sum = array_sum($rating_data);
            $ratings_average = $ratings_sum / $ratings_submiter;
            $final_rating = number_format($ratings_average, 1, '.', '');
        }

        return view('Frontend.qrview', ['data' => $business, 'rating' => $final_rating]);
    }

    public function laporanform($id)
    {
        $business = Business::find($id);

    	return view('Frontend.form', ['data' => $business]);
    }

    public function sending(Request $request)
    {
        $datalaporan = DB::table('reports')
                    ->select('reporter', DB::raw('DATE(`created_at`) as date'), 'business_id')
                    ->whereIn('id', function($query){
                        $query->selectRaw('max(id) from `reports`')->groupBy('reporter');
                    })
                    ->orderBy('reporter')
                    ->get();

        $date = Carbon::now()->toDateString();

        foreach ($datalaporan as $laporan) {
            if($request->ip == $laporan->reporter && $date == $laporan->date && $request->id == $laporan->business_id)
            {
                return view('Frontend.sorry');
            }
        }

        $reports = new Report;
        $reports->rating = $request->rating;
        $reports->grade = $request->about;
        $reports->description = $request->description;
        $reports->business_id = $request->id;
        $reports->reporter = $request->ip;
        $reports->save();

        $rating = new Rating;
        $rating->grade = $request->about;
        $rating->rate_value = $request->rating;
        $rating->business_id = $request->id;
        $rating->save();

        return view('Frontend.thanks');
    }
}
