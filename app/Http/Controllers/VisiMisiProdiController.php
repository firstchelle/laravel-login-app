<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiProdi; // <-- WAJIB TAMBAHKAN

class VisiMisiProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = VisiMisiProdi::all();
        return view('visi.prodi', compact('data'));
    }

    public function createmisi()
    {
        return view('visi.prodi.createmisiprodi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visi.prodi.createvisiprodi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        VisiMisiProdi::create($request->all());
        return redirect()->route('visi.prodi');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = VisiMisiProdi::findOrFail($id);
        return view('visi.prodi.editvisiprodi', compact('item'));
    }

    public function editmisi(string $id)
    {
        $item = VisiMisiProdi::findOrFail($id);
        return view('visi.prodi.editmisiprodi', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        VisiMisiProdi::findOrFail($id)->update($request->all());
        return redirect()->route('visi.prodi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        VisiMisiProdi::findOrFail($id)->delete();
        return redirect()->route('visi.prodi');
    }
}
