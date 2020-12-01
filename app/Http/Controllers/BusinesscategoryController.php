<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business_category;

class BusinesscategoryController extends Controller
{
    public function view()
    {
        $category = Business_category::all();
        return view('Backend.Business_category.index', ['category' => $category]);
    }

    public function add()
    {
        return view('Backend.Business_category.create');
    }

    public function create(Request $request)
    {
        Business_category::create(['name' => $request->name]);
        return redirect(url('/dapur/business-category'))->with('created','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $category = Business_category::findOrFail($id);
        return view('Backend.Business_category.edit', ['data' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Business_category::findOrFail($id);
        $category->name = $request->name;
        $process = $category->save();

        if ($process) {
            return redirect(url('/dapur/business-category'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $category = Business_category::find($id);
        $process = $category->delete();

        if ($process) {
            return redirect(url('/dapur/business-category'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }
}
