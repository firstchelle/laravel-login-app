<?php

namespace App\Http\Controllers;

use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Http\Request;


class CapaianProfilLulusanController extends Controller
{
    public function index() 
    { 
        $capaian = \App\Models\CapaianProfilLulusan::with('profilLulusan') ->orderBy('created_at', 'desc') ->paginate(10); // paginator instead of collection 
        return view('capaian.index', compact('capaian')); 
    }


    public function create()
    {
        $profilLulusans = ProfilLulusan::all();
        return view('capaian.create', compact('profilLulusans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen_pengisi' => 'required|string|max:255',
            'tanggal_dibuat' => 'required|date',
            'capaian_profil_lulusan' => 'required|string',
            'deskripsi_capaian_profil_lulusan' => 'required|string',
            'profil_lulusan_id' => 'required|exists:profil_lulusans,id',
        ]);

        CapaianProfilLulusan::create($request->all());

        return redirect()->route('capaian.index')->with('success', 'Capaian Profil Lulusan created successfully.');
    }


    public function show($id)
    {
        $cpl = CapaianProfilLulusan::with('profilLulusan')->findOrFail($id);
        return view('capaian.show', compact('cpl'));
    }



    public function edit($id)
    {
        $cpl = CapaianProfilLulusan::findOrFail($id);
        $profilLulusans = ProfilLulusan::all();
        return view('capaian.edit', compact('cpl', 'profilLulusans'));
    }


    public function update(Request $request, CapaianProfilLulusan $capaian)
    {
        $request->validate([
            'nama_dosen_pengisi' => 'required|string|max:255',
            'tanggal_dibuat' => 'required|date',
            'capaian_profil_lulusan' => 'required|string',
            'deskripsi_capaian_profil_lulusan' => 'required|string',
            'profil_lulusan_id' => 'required|exists:profil_lulusans,id',
        ]);

        $capaian->update($request->all());

        return redirect()->route('capaian.index')->with('success', 'Capaian Profil Lulusan updated successfully.');
    }

    public function destroy(CapaianProfilLulusan $capaian)
    {
        $capaian->delete();
        return redirect()->route('capaian.index')->with('success', 'Capaian Profil Lulusan deleted successfully.');
    }
}
