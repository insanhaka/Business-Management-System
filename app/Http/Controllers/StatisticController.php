<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Business;
use DB;

class StatisticController extends Controller
{
    public function view()
    {
        $data = Report::where('rating', 5)->orderBy('count', 'desc')->select(DB::raw('business_id, count(*) as count'))->groupBy('business_id')->get();
        // dd($data);
        $business = Business::all();
        // dd($business);
        return view('Backend.Statistic.index', ['count' => $data, 'business' => $business]);
    }
}
