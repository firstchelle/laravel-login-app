<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiFakultas; // <-- WAJIB TAMBAHKAN
use Illuminate\Support\Facades\Storage;

class VisiMisiFakultasController extends Controller
{
    public function index()
    {
        $data_visi = VisiMisiFakultas::where('jenis', 'visi')->with("children")->get();
        return view('visi.fakultas', compact('data_visi'));
    }

    public function create()
    {
        $data_misi = VisiMisiFakultas::where('jenis', 'misi')->get();
        return view('visi.fakultas.createvisifakultas', compact('data_misi'));
    }

    public function store(Request $request)
    {
        // Validate VISI
        $validate = $request->validate([
            'visimisi' => 'required|string',
            'jenis' => 'required|in:visi,misi',
            'dokumen' => 'nullable|mimes:pdf|max:2048',
            'berlaku_sampai' => 'nullable|date',
            'misi_ids' => 'nullable|array',
        ]);

        // Upload dokumen
        $path = $request->file('dokumen')?->store('dokumen', 'public');
        $validate['file_path'] = $path;

        $visi = VisiMisiFakultas::create($validate);

        // Simpan relasi misi → visi
        if ($request->filled('misi_ids')) {
            foreach ($request->misi_ids as $mid) {
                VisiMisiFakultas::where('id', $mid)->update([
                    'parent_id' => $visi->id
                ]);
            }
        }

        return redirect()->route('visifakultas.index');
    }

    public function edit($id)
    {
        $item = VisiMisiFakultas::with('children')->findOrFail($id);
        $data_misi = VisiMisiFakultas::where('jenis', 'misi')->get(); // semua misi
        return view('visi.fakultas.editvisifakultas', compact('item', 'data_misi'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
            'jenis' => 'required|in:visi,misi',
            'dokumen' => 'nullable|mimes:pdf|max:2048',
            'berlaku_sampai' => 'nullable|date',
            'misi_ids' => 'nullable|array',
        ]);

        $item = VisiMisiFakultas::findOrFail($id);

        // Perbarui file
        if ($request->hasFile('dokumen')) {

            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $path = $request->file('dokumen')->store('dokumen', 'public');
            $validate['file_path'] = $path;
        }

        // Update data utama
        $item->update($validate);

        VisiMisiFakultas::where('parent_id', $id)->update(['parent_id' => null]);

        if ($request->filled('misi_ids')) {
            VisiMisiFakultas::whereIn('id', $request->misi_ids)
                ->update(['parent_id' => $id]);
        }

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

    public function storeMisiAjax(Request $request)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
        ]);

        $data = VisiMisiFakultas::create([
            'visimisi' => $validate['visimisi'],
            'jenis' => 'misi'
        ]);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function getAllMisi()
    {
        return VisiMisiFakultas::where('jenis', 'misi')
            ->select('id', 'visimisi')
            ->get();
    }
}
