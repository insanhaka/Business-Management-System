<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business_owner;
use App\Models\Business;
use App\Models\Product_category;
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

}
