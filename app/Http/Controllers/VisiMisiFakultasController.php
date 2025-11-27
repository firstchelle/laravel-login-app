<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiFakultas; // <-- WAJIB TAMBAHKAN

class VisiMisiFakultasController extends Controller
{
    public function index()
    {
        $data = VisiMisiFakultas::all();
        return view('visi.fakultas', compact('data'));
    }

    public function createmisi()
    {
        return view('visi.fakultas.createmisifakultas');
    }

    public function create()
    {
        return view('visi.fakultas.createvisifakultas');
    }
    public function store(Request $request)
    {
        VisiMisiFakultas::create($request->all());
        return redirect()->route('fakultas.index');
    }
    public function edit(string $id)
    {
        $item = VisiMisiFakultas::findOrFail($id);
        return view('visi.fakultas.editvisifakultas', compact('item'));
    }

    public function editmisi(string $id)
    {
        $item = VisiMisiFakultas::findOrFail($id);
        return view('visi.fakultas.editmisifakultas', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        VisiMisiFakultas::findOrFail($id)->update($request->all());
        return redirect()->route('fakultas.index');
    }
    public function destroy(string $id)
    {
        VisiMisiFakultas::findOrFail($id)->delete();
        return redirect()->route('fakultas.index');
    }
}
