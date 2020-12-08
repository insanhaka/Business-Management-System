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
        $create = new Product_category;
        $create->name = $request->name;

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('icon');
        if($file == null){
            $nama_file = "";
            $create->icon = $nama_file;
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'menus_icon';
            $file->move($tujuan_upload, $nama_file);
            $create->icon = $nama_file;
        }

        $process= $create->save();
        if ($process) {
            return redirect(url('/dapur/product-category'))->with('created','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }

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

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('icon');
        if($file == null){
            $nama_file = "";
            $product_category->icon = $nama_file;
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'menus_icon';
            $file->move($tujuan_upload, $nama_file);
            $product_category->icon = $nama_file;
        }

        $process= $product_category->save();
        if ($process) {
            return redirect(url('/dapur/product-category'))->with('created','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
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
