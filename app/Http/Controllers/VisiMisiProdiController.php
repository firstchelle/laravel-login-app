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
        $data_visi = VisiMisiProdi::where('jenis', 'visi')->get();
        $data_misi = VisiMisiProdi::where('jenis', 'misi')->get();
        return view('visi.prodi', compact('data_visi', 'data_misi'));
    }

    public function create()
    {
        return view('visi.prodi.createvisiprodi');
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

        VisiMisiProdi::create($validate);
        return redirect()->route('visiprodi.index');
    }

    public function edit($id)
    {
        $item = VisiMisiProdi::findOrFail($id);
        return view('visi.prodi.editvisiprodi', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
            'jenis' => 'required|in:visi,misi',
            'dokumen' => 'nullable|mimes:pdf|max:2048',
            'berlaku_sampai' => 'nullable|date',
        ]);

        $item = VisiMisiProdi::findOrFail($id);

        // Jika ada file baru diupload
        if ($request->hasFile('dokumen')) {

            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $path = $request->file('dokumen')->store('dokumen', 'public');
            $validate['file_path'] = $path;
        }

        $item->update($validate);
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
}
