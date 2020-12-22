<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function view()
    {
        $report = Report::all()->sortByDesc('created_at');
        // dd($report);
        return view('Backend.Report.index', ['report' => $report]);
    }
}
