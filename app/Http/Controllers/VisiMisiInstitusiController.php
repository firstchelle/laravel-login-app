<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiInstitusi; // <-- WAJIB TAMBAHKAN
use Illuminate\Support\Facades\Storage;

class VisiMisiInstitusiController extends Controller
{
    public function index()
    {
        $data_visi = VisiMisiInstitusi::where('jenis', 'visi')->with("children")->get();
        return view('visi.institusi', compact('data_visi'));
    }

    public function create()
    {
        $data_misi = VisiMisiInstitusi::where('jenis', 'misi')->get();
        return view('visi.institusi.createvisiinstitusi', compact('data_misi'));
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

        $visi = VisiMisiInstitusi::create($validate);

        // Simpan relasi misi → visi
        if ($request->filled('misi_ids')) {
            foreach ($request->misi_ids as $mid) {
                VisiMisiInstitusi::where('id', $mid)->update([
                    'parent_id' => $visi->id
                ]);
            }
        }

        return redirect()->route('visiinstitusi.index');
    }

    public function edit($id)
    {
        $item = VisiMisiInstitusi::with('children')->findOrFail($id);
        $data_misi = VisiMisiInstitusi::where('jenis', 'misi')->get(); // semua misi
        return view('visi.institusi.editvisiinstitusi', compact('item', 'data_misi'));
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

        $item = VisiMisiInstitusi::findOrFail($id);

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

        VisiMisiInstitusi::where('parent_id', $id)->update(['parent_id' => null]);

        if ($request->filled('misi_ids')) {
            VisiMisiInstitusi::whereIn('id', $request->misi_ids)
                ->update(['parent_id' => $id]);
        }

        return redirect()->route('visiinstitusi.index');
    }


    public function destroy($id)
    {
        $item = VisiMisiInstitusi::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return redirect()->route('visiinstitusi.index');
    }

    public function storeMisiAjax(Request $request)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
        ]);

        $data = VisiMisiInstitusi::create([
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
        return VisiMisiInstitusi::where('jenis', 'misi')
            ->select('id', 'visimisi')
            ->get();
    }
}
