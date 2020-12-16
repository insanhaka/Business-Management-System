<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_photo;
use App\Models\Business;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class ProductController extends Controller
{

    public function __construct(){
        $today = Carbon::today();
        $fourRandomDigit = mt_rand(0000,9999);
        $date = Carbon::parse($today)->timestamp;
        $this->generateID = $date+$fourRandomDigit;
    }

    public function view()
    {
        $product = Product::all();
        return view('Backend.Product.index', ['product' => $product]);
    }

    public function add()
    {
        $category = Product_category::all();
        $business = Business::all();
        return view('Backend.Product.create', ['category' => $category, 'business' => $business]);
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $id = $this->generateID;
        $check_id = Business::where('id', $id)->first();
        if ($check_id == null) {
            $fix_id = $id;
        }else{
            $fix_id = $this->generateID;
        }

        $get_business_id = Str::after($request->business_id, '-');
        $business_id = Business::findOrFail($get_business_id);

        $price = str_replace('.', '', $request->price);

        $photo = $request->file('title');

        if ($photo == null) {
            $data = new Product;
            $data->id = $fix_id;
            $data->name = $request->name;
            $data->description = $request->description;
            $data->stock = $request->stock;
            $data->price = $price;
            $data->is_active = $request->is_active;
            $data->business_id = $business_id->id;
            $data->product_categories_id = $request->product_categories_id;

            $process = $data->save();
            if ($process) {
                return redirect(url('/dapur/product'))->with('created', 'Success');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }

        }else {

            foreach( $photo as $img )
            {
                $nama_file = time()."_".$img->getClientOriginalName();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'product_photo';
                $img->move($tujuan_upload, $nama_file);
                $savephoto = Product_photo::create([
                    'title' => $nama_file,
                    'product_id' => $fix_id
                ]);
            }

            $data = new Product;
            $data->id = $fix_id;
            $data->name = $request->name;
            $data->description = $request->description;
            $data->stock = $request->stock;
            $data->price = $price;
            $data->is_active = $request->is_active;
            $data->business_id = $business_id->id;
            $data->product_categories_id = $request->product_categories_id;

            $process = $data->save();

            if ($process) {
                return redirect(url('/dapur/product'))->with('created', 'Success');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }

            
        }

    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Product_category::all();
        return view('Backend.Product.edit', ['product' => $product, 'category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $photo = $request->file('title');
        $price = str_replace('.', '', $request->price);
        $data = Product::findOrFail($id);

        if($photo == null){

            $data->name = $request->name;
            $data->description = $request->description;
            $data->stock = $request->stock;
            $data->price = $price;
            $data->product_categories_id = $request->product_categories_id;

            $process = $data->save();
            if ($process) {
                return redirect(url('/dapur/product'))->with('created', 'Success');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }else{

            $check_photo = Product_photo::where('product_id', $id)->get();
            foreach ($check_photo as $item) {
                $data[] = $item->id;
            }
            $photo_dell = Product_photo::destroy($data);
            
            foreach( $photo as $img )
            {
                $nama_file = time()."_".$img->getClientOriginalName();
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'product_photo';
                $img->move($tujuan_upload, $nama_file);
                $savephoto = Product_photo::create([
                    'title' => $nama_file,
                    'product_id' => $id
                ]);
            }

            $data->name = $request->name;
            $data->description = $request->description;
            $data->stock = $request->stock;
            $data->price = $price;
            $data->product_categories_id = $request->product_categories_id;

            $process = $data->save();

            if ($process) {
                return redirect(url('/dapur/product'))->with('created', 'Success');
            }else {
                return back()->with('warning','Data Gagal Disimpan');
            }

        }

    }

    public function delete($id)
    {
        $photo = Product_photo::where('product_id', $id)->get();
        foreach ($photo as $img) {
            $data[] = $img->id;
        }
        $phodell = Product_photo::destroy($data);

        $product = Product::find($id);
        $prodell = $product->delete();

        if ($prodell && $phodell) {
            return redirect(url('/dapur/product'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }

    public function activation(Request $request)
    {
        $id = $request->id;
        // dd($id);

        $business = Product::findOrFail($id);
        $business->is_active = $request->is_active;

        $process = $business->save();
    }
}
