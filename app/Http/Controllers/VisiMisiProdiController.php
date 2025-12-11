<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiProdi; // <-- WAJIB TAMBAHKAN
use Illuminate\Support\Facades\Storage;

class VisiMisiProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_visi = VisiMisiProdi::where('jenis', 'visi')->with("children")->get();
        return view('visi.prodi', compact('data_visi'));
    }

    public function create()
    {
        $data_misi = VisiMisiProdi::where('jenis', 'misi')->get();
        return view('visi.prodi.createvisiprodi', compact('data_misi'));
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

        $visi = VisiMisiProdi::create($validate);

        // Simpan relasi misi → visi
        if ($request->filled('misi_ids')) {
            foreach ($request->misi_ids as $mid) {
                VisiMisiProdi::where('id', $mid)->update([
                    'parent_id' => $visi->id
                ]);
            }
        }

        return redirect()->route('visiprodi.index');
    }

    public function edit($id)
    {
        $item = VisiMisiProdi::with('children')->findOrFail($id);
        $data_misi = VisiMisiProdi::where('jenis', 'misi')->get(); // semua misi
        return view('visi.prodi.editvisiprodi', compact('item', 'data_misi'));
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

        $item = VisiMisiProdi::findOrFail($id);

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

        VisiMisiProdi::where('parent_id', $id)->update(['parent_id' => null]);

        if ($request->filled('misi_ids')) {
            VisiMisiProdi::whereIn('id', $request->misi_ids)
                ->update(['parent_id' => $id]);
        }

        return redirect()->route('visiprodi.index');
    }

    public function destroy($id)
    {
        $item = VisiMisiProdi::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return redirect()->route('visiprodi.index');
    }

    public function storeMisiAjax(Request $request)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
        ]);

        $data = VisiMisiProdi::create([
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
        return VisiMisiProdi::where('jenis', 'misi')
            ->select('id', 'visimisi')
            ->get();
    }
}
