<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;

class CommunityController extends Controller
{
    public function view()
    {
        $community = Community::all();
        return view('Backend.Community.index', ['community' => $community]);
    }

    public function add()
    {
        return view('Backend.Community.create');
    }

    public function create(Request $request)
    {
        // dd($request->all());
        Community::create($request->all());
        return redirect(url('/dapur/community'))->with('created','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $community = Community::findOrFail($id);
        return view('Backend.Community.edit', ['data' => $community]);
    }

    public function update(Request $request, $id)
    {
        $community = Community::findOrFail($id);
        // $community->name = $request->name;
        $process = $community->update($request->all());

        if ($process) {
            return redirect(url('/dapur/community'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $community = Community::find($id);
        $process = $community->delete();

        if ($process) {
            return redirect(url('/dapur/community'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }
}
