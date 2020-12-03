<?php

use Illuminate\Support\Facades\Route;

//===============FRONTEND ROUTE===============//
use App\Http\Controllers\FrontlandingController;

//===============BACKEND ROUTE================//
use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\BusinesscategoryController;
use App\Http\Controllers\CommunityController;




//=========================FRONTEND ROUTE=================================//

Route::get('/', [FrontlandingController::class, 'index'])->name('landing');

//=========================BACKEND ROUTE=================================//

Route::get('/login', [AuthorizeController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthorizeController::class, 'postlogin']);
Route::get('/signup', [AuthorizeController::class, 'signup'])->name('signup');
Route::post('/postsignup', [AuthorizeController::class, 'postsignup']);
Route::get('/notactive', [AuthorizeController::class, 'notactive'])->name('notactive');

Route::group(['prefix' => 'dapur', 'middleware' => 'auth'], function () {

    Route::get('/logout', [AuthorizeController::class, 'logout']);

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Route Untuk Super Admin
    Route::get('/super/dashboard', [UsersController::class, 'index'])->name('admin');
    Route::get('/super/view', [UsersController::class, 'view']);
    Route::get('/super/view/{id}/edit', [UsersController::class, 'edit']);
    Route::post('/super/view/{id}/update', [UsersController::class, 'update']);
    Route::get('/super/view/{id}/delete', [UsersController::class, 'delete']);
    Route::post('/super/activation', [UsersController::class, 'activation']);

    Route::get('/super/roles', [RolesController::class, 'view'])->name('roles');
    Route::get('/super/roles/add', [RolesController::class, 'add']);
    Route::post('/super/roles/create', [RolesController::class, 'create']);
    Route::get('/super/roles/{id}/edit', [RolesController::class, 'edit']);
    Route::post('/super/roles/{id}/update', [RolesController::class, 'update']);
    Route::get('/super/roles/{id}/delete', [RolesController::class, 'delete']);

    Route::get('/super/permission', [PermissionController::class, 'view'])->name('permission');
    Route::get('/super/permission/add', [PermissionController::class, 'add']);
    Route::post('/super/permission/create', [PermissionController::class, 'create']);
    Route::get('/super/permission/{id}/show', [PermissionController::class, 'show']);
    Route::get('/super/permission/{id}/edit', [PermissionController::class, 'edit']);
    Route::post('/super/permission/{id}/update', [PermissionController::class, 'update']);
    Route::get('/super/permission/{id}/delete', [PermissionController::class, 'delete']);

    Route::get('/super/menu', [MenuController::class, 'view'])->name('menu');
    Route::get('/super/menu/add', [MenuController::class, 'add']);
    Route::post('/super/menu/create', [MenuController::class, 'create']);
    Route::get('/super/menu/{id}/edit', [MenuController::class, 'edit']);
    Route::post('/super/menu/{id}/update', [MenuController::class, 'update']);
    Route::get('/super/menu/{id}/delete', [MenuController::class, 'delete']);
    Route::post('/menu/activation', [MenuController::class, 'activation']);

    //Route Untuk Admin Lain (Sesuai Menu)

    Route::get('/user/{id}/profile', [UsersController::class, 'profile']);

    Route::get('/business-sector', [SectorController::class, 'view'])->name('business-sector');
    Route::get('/business-sector/add', [SectorController::class, 'add']);
    Route::post('/business-sector/create', [SectorController::class, 'create']);
    Route::get('/business-sector/edit/{id}', [SectorController::class, 'edit']);
    Route::post('/business-sector/update/{id}', [SectorController::class, 'update']);
    Route::get('/business-sector/delete/{id}', [SectorController::class, 'delete']);

    Route::get('/community', [CommunityController::class, 'view'])->name('community');
    Route::get('/community/add', [CommunityController::class, 'add']);
    Route::post('/community/create', [CommunityController::class, 'create']);
    Route::get('/community/edit/{id}', [CommunityController::class, 'edit']);
    Route::post('/community/update/{id}', [CommunityController::class, 'update']);
    Route::get('/community/delete/{id}', [CommunityController::class, 'delete']);

    Route::get('/business-category', [BusinesscategoryController::class, 'view'])->name('business-category');
    Route::get('/business-category/add', [BusinesscategoryController::class, 'add']);
    Route::post('/business-category/create', [BusinesscategoryController::class, 'create']);
    Route::get('/business-category/edit/{id}', [BusinesscategoryController::class, 'edit']);
    Route::post('/business-category/update/{id}', [BusinesscategoryController::class, 'update']);
    Route::get('/business-category/delete/{id}', [BusinesscategoryController::class, 'delete']);

    Route::get('/business', [BusinessController::class, 'view'])->name('business');
    Route::get('/business/add', [BusinessController::class, 'add']);
    Route::post('/business/create', [BusinessController::class, 'create']);
    Route::get('/business/edit/{id}', [BusinessController::class, 'edit']);
    Route::post('/business/update/{id}', [BusinessController::class, 'update']);
    Route::get('/business/delete/{id}', [BusinessController::class, 'delete']);
    Route::get('/business/show/{id}', [BusinessController::class, 'show']);
    Route::post('/business/activation', [BusinessController::class, 'activation']);

    Route::get('/business/owner/add', [OwnerController::class, 'add']);
    Route::post('/business/owner/create', [OwnerController::class, 'create']);
    Route::get('/business/owner/edit/{id}', [OwnerController::class, 'edit']);
    Route::post('/business/owner/update/{id}', [OwnerController::class, 'update']);
    Route::get('/business/owner/delete/{id}', [OwnerController::class, 'delete']);
    Route::get('/business/owner/show/{id}', [OwnerController::class, 'show']);


    Route::post('/getRegenciesFromProvince', function (Request $request) {
        $arrRegencies = App\Regency::where('province_id', $request->paramid)->orderBy('name','asc')->pluck('id','name')->prepend('','');
        return response()->json(['code' => 200,'data' => $arrRegencies], 200);
    })->name('getregenciesfromprovince');

});
