<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiInstitusi; // <-- WAJIB TAMBAHKAN

class VisiMisiInstitusiController extends Controller
{
    public function index()
    {
        $data = VisiMisiInstitusi::all();
        return view('visi.institusi', compact('data'));
    }

    public function create()
    {
        return view('visi.institusi.createvisiinstitusi');
    }

    public function createmisi()
    {
        return view('visi.institusi.createmisiinstitusi');
    }

    public function store(Request $request)
    {
        VisiMisiInstitusi::create($request->all());
        return redirect()->route('institusi.index');
    }

    public function edit($id)
    {
        $item = VisiMisiInstitusi::findOrFail($id);
        return view('visi.institusi.editvisiinstitusi', compact('item'));
    }

    public function editmisi($id)
    {
        $item = VisiMisiInstitusi::findOrFail($id);
        return view('visi.institusi.editmisiinstitusi', compact('item'));
    }

    public function update(Request $request, $id)
    {
        VisiMisiInstitusi::findOrFail($id)->update($request->all());
        return redirect()->route('institusi.index');
    }

    public function destroy($id)
    {
        VisiMisiInstitusi::findOrFail($id)->delete();
        return redirect()->route('institusi.index');
    }
}
