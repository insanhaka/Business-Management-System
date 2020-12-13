<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class FrontQRCodeController extends Controller
{
    public function index($id)
    {
        $business = Business::find($id);

        return view('Frontend.qrview', ['business' => $business]);
    }
}
