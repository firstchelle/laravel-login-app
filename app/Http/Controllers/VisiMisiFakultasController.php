<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiFakultas; // <-- WAJIB TAMBAHKAN
use Illuminate\Support\Facades\Storage;

class VisiMisiFakultasController extends Controller
{
    public function index()
    {
        $data_visi = VisiMisiFakultas::where('jenis', 'visi')->get();
        $data_misi = VisiMisiFakultas::where('jenis', 'misi')->get();
        return view('visi.fakultas', compact('data_visi', 'data_misi'));
    }

    public function create()
    {
        return view('visi.fakultas.createvisifakultas');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
            'jenis' => 'required|in:visi,misi',
            'dokumen' => 'nullable|mimes:pdf|max:2048',
            'berlaku_sampai' => 'nullable|date',
        ]);

        // nama dokumen
        $path = $request->file('dokumen')?->store('dokumen', 'public');
        $validate['file_path'] = $path;

        VisiMisiFakultas::create($validate);
        return redirect()->route('visifakultas.index');
    }

    public function edit($id)
    {
        $item = VisiMisiFakultas::findOrFail($id);
        return view('visi.fakultas.editvisifakultas', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
            'jenis' => 'required|in:visi,misi',
            'dokumen' => 'nullable|mimes:pdf|max:2048',
            'berlaku_sampai' => 'nullable|date',
        ]);

        $item = VisiMisiFakultas::findOrFail($id);

        // Jika ada file baru diupload
        if ($request->hasFile('dokumen')) {

            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $path = $request->file('dokumen')->store('dokumen', 'public');
            $validate['file_path'] = $path;
        }

        $item->update($validate);
        return redirect()->route('visifakultas.index');
    }

    public function destroy($id)
    {
        $item = VisiMisiFakultas::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return redirect()->route('visifakultas.index');
    }
}
