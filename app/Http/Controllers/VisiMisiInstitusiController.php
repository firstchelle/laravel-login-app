<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiInstitusi;
use App\Models\MisiInstitusi;
use Illuminate\Support\Facades\Storage;

class VisiMisiInstitusiController extends Controller
{
    public function index()
    {
        $visi = VisiInstitusi::all();
        $misi = MisiInstitusi::all();

        return view('visi.institusi', compact('visi', 'misi'));
    }

    public function create_visi()
    {
        return view('visi.institusi.create_visi');
    }

    public function edit_visi($id)
    {
        $item = VisiInstitusi::findOrFail($id);
        return view('visi.institusi.edit_visi', compact('item'));
    }

    public function store_visi(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'visi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen', 'public');
        } else {
            $path = null;
        }

        VisiInstitusi::create([
            'visi' => $request->visi,
            'file_path' => $path,
            'berlaku_sampai' => $request->input('berlaku_sampai'),
        ]);

        return redirect()->route('visiinstitusi.index');
    }

    public function update_visi(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        $item = VisiInstitusi::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $path = $request->file('dokumen')->store('dokumen', 'public');
            $item->file_path = $path;
        }

        $item->visi = $request->visi;
        $item->berlaku_sampai = $request->input('berlaku_sampai');
        $item->save();

        return redirect()->route('visiinstitusi.index');
    }

    public function hapus_visi($id)
    {
        $item = VisiInstitusi::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return redirect()->route('visiinstitusi.index');
    }

    /**
     * Semua fungsi untuk CRUD VISI
     */

    public function create_misi()
    {
        $visi = VisiInstitusi::all();
        return view('visi.institusi.create_misi', compact('visi'));
    }

    public function edit_misi($id)
    {
        $item = MisiInstitusi::findOrFail($id);
        $visi = VisiInstitusi::all();

        return view('visi.institusi.edit_misi', compact('item', 'visi'));
    }

    public function store_misi(Request $request)
    {
        $request->validate([
            'visi_institusi_id' => 'required|exists:visi_institusis,id',
            'misi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen', 'public');
        } else {
            $path = null;
        }

        MisiInstitusi::create([
            'visi_institusi_id' => $request->visi_institusi_id,
            'misi' => $request->misi,
            'file_path' => $path,
            'berlaku_sampai' => $request->input('berlaku_sampai'),
        ]);

        return redirect()->route('visiinstitusi.index');
    }

    public function update_misi(Request $request, $id)
    {
        $request->validate([
            'visi_institusi_id' => 'required|exists:visi_institusis,id',
            'misi' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf|max:5120',
            'berlaku_sampai' => 'required|date',
        ], [
            'visi_institusi_id.required' => 'Visi harus dipilih',
            'visi_institusi_id.exists' => 'Visi yang dipilih tidak valid',
            'misi.required' => 'Misi harus diisi',
            'berlaku_sampai.required' => 'Tanggal berlaku sampai harus diisi',
        ]);

        $misi = MisiInstitusi::findOrFail($id);

        $data = [
            'visi_institusi_id' => $request->visi_institusi_id,
            'misi' => $request->misi,
            'berlaku_sampai' => $request->berlaku_sampai,
        ];

        if ($request->hasFile('dokumen')) {
            if ($misi->file_path && Storage::disk('public')->exists($misi->file_path)) {
                Storage::disk('public')->delete($misi->file_path);
            }

            $data['file_path'] = $request->file('dokumen')->store('misi-institusi', 'public');
        }

        $misi->update($data);

        return redirect()->route('visiinstitusi.index')
            ->with('success', 'Misi berhasil diperbarui');
    }

    public function hapus_misi($id)
    {
        $item = MisiInstitusi::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();

        return redirect()->route('visiinstitusi.index')
            ->with('success', 'Misi berhasil dihapus');
    }
}
