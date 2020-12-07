<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_category;

class ProductcategoryController extends Controller
{
    public function view()
    {
        $product_category = Product_category::all();
        return view('Backend.Product_category.index', ['category' => $product_category]);
    }

    public function add()
    {
        return view('Backend.Product_category.create');
    }

    public function create(Request $request)
    {
        Product_category::create(['name' => $request->name]);
        return redirect(url('/dapur/product-category'))->with('created','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $product_category = Product_category::findOrFail($id);
        return view('Backend.Product_category.edit', ['data' => $product_category]);
    }

    public function update(Request $request, $id)
    {
        $product_category = Product_category::findOrFail($id);
        $product_category->name = $request->name;
        $process = $product_category->save();

        if ($process) {
            return redirect(url('/dapur/product-category'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $product_category = Product_category::find($id);
        $process = $product_category->delete();

        if ($process) {
            return redirect(url('/dapur/product-category'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }
}
