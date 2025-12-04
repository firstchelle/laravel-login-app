<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisiInstitusi; // <-- WAJIB TAMBAHKAN
use Illuminate\Support\Facades\Storage;

class VisiMisiInstitusiController extends Controller
{
    public function index()
    {
        $data_visi = VisiMisiInstitusi::where('jenis', 'visi')->get();
        $data_misi = VisiMisiInstitusi::where('jenis', 'misi')->get();
        return view('visi.institusi', compact('data_visi', 'data_misi'));
    }

    public function create()
    {
        return view('visi.institusi.createvisiinstitusi');
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

        VisiMisiInstitusi::create($validate);
        return redirect()->route('visiinstitusi.index');
    }

    public function edit($id)
    {
        $item = VisiMisiInstitusi::findOrFail($id);
        return view('visi.institusi.editvisiinstitusi', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'visimisi' => 'required|string',
            'jenis' => 'required|in:visi,misi',
            'dokumen' => 'nullable|mimes:pdf|max:2048',
            'berlaku_sampai' => 'nullable|date',
        ]);

        $item = VisiMisiInstitusi::findOrFail($id);

        // Jika ada file baru diupload
        if ($request->hasFile('dokumen')) {

            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            $path = $request->file('dokumen')->store('dokumen', 'public');
            $validate['file_path'] = $path;
        }

        $item->update($validate);
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
}
