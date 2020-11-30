<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    public function view()
    {
        $sector = Sector::all();
        return view('Backend.Sector.index', ['sector' => $sector]);
    }

    public function add()
    {
        return view('Backend.Sector.create');
    }

    public function create(Request $request)
    {
        Sector::create(['name' => $request->name]);
        return redirect(url('/dapur/business-sector'))->with('created','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $sector = Sector::findOrFail($id);
        return view('Backend.Sector.edit', ['data' => $sector]);
    }

    public function update(Request $request, $id)
    {
        $sector = Sector::findOrFail($id);
        $sector->name = $request->name;
        $process = $sector->save();

        if ($process) {
            return redirect(url('/dapur/business-sector'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $sector = Sector::find($id);
        $process = $sector->delete();

        if ($process) {
            return redirect(url('/dapur/business-sector'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }
}
