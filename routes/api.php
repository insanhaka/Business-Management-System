<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('data-user', [ApiController::class, 'datauser']);
Route::get('data-business', [ApiController::class, 'databusiness']);
Route::get('data-owner', [ApiController::class, 'dataowner']);
Route::get('data-product-category', [ApiController::class, 'dataproductcategory']);
Route::get('data-product', [ApiController::class, 'dataproduct']);
Route::get('data-photo-product', [ApiController::class, 'dataphotoproduct']);
Route::get('data-report', [ApiController::class, 'datareport']);
Route::get('data-report-custome', [ApiController::class, 'datareportcustome']);
Route::get('data-grade-report', [ApiController::class, 'gradereport']);
Route::get('data-prokes-agree-count', [ApiController::class, 'prokesagree']);

Route::post('seller-register', [ApiController::class, 'sellerregister']);
