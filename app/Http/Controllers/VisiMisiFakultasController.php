<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiFakultas;
use App\Models\MisiFakultas;
use Illuminate\Support\Facades\Storage;

class VisiMisiFakultasController extends Controller
{
    public function index()
    {
        $visi = VisiFakultas::all();
        $misi = MisiFakultas::all();

        return view('visi.fakultas', compact('visi', 'misi'));
    }

    public function create_visi()
    {
        return view('visi.fakultas.create_visi');
    }

    public function edit_visi($id)
    {
        $item = VisiFakultas::findOrFail($id);
        return view('visi.fakultas.edit_visi', compact('item'));
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

        VisiFakultas::create([
            'visi' => $request->visi,
            'file_path' => $path,
            'berlaku_sampai' => $request->input('berlaku_sampai'),
        ]);

        return redirect()->route('visifakultas.index');
    }

    public function update_visi(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        $item = VisiFakultas::findOrFail($id);

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

        return redirect()->route('visifakultas.index');
    }

    public function hapus_visi($id)
    {
        $item = VisiFakultas::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return redirect()->route('visifakultas.index');
    }

    /**
     * Semua fungsi untuk CRUD VISI
     */

    public function create_misi()
    {
        $visi = VisiFakultas::all();
        return view('visi.fakultas.create_misi', compact('visi'));
    }

    public function edit_misi($id)
    {
        $item = MisiFakultas::findOrFail($id);
        $visi = VisiFakultas::all();

        return view('visi.fakultas.edit_misi', compact('item', 'visi'));
    }

    public function store_misi(Request $request)
    {
        $request->validate([
            'visi_fakultas_id' => 'required|exists:visi_fakultas,id',
            'misi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen', 'public');
        } else {
            $path = null;
        }

        MisiFakultas::create([
            'visi_fakultas_id' => $request->visi_fakultas_id,
            'misi' => $request->misi,
            'file_path' => $path,
            'berlaku_sampai' => $request->input('berlaku_sampai'),
        ]);

        return redirect()->route('visifakultas.index');
    }

    public function update_misi(Request $request, $id)
    {
        $request->validate([
            'visi_fakultas_id' => 'required|exists:visi_fakultas,id',
            'misi' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf|max:5120',
            'berlaku_sampai' => 'required|date',
        ], [
            'visi_fakultas_id.required' => 'Visi harus dipilih',
            'visi_fakultas_id.exists' => 'Visi yang dipilih tidak valid',
            'misi.required' => 'Misi harus diisi',
            'berlaku_sampai.required' => 'Tanggal berlaku sampai harus diisi',
        ]);

        $misi = MisiFakultas::findOrFail($id);

        $data = [
            'visi_fakultas_id' => $request->visi_fakultas_id,
            'misi' => $request->misi,
            'berlaku_sampai' => $request->berlaku_sampai,
        ];

        if ($request->hasFile('dokumen')) {
            if ($misi->file_path && Storage::disk('public')->exists($misi->file_path)) {
                Storage::disk('public')->delete($misi->file_path);
            }

            $data['file_path'] = $request->file('dokumen')->store('misi-fakultas', 'public');
        }

        $misi->update($data);

        return redirect()->route('visifakultas.index')
            ->with('success', 'Misi berhasil diperbarui');
    }

    public function hapus_misi($id)
    {
        $item = MisiFakultas::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();

        return redirect()->route('visifakultas.index')
            ->with('success', 'Misi berhasil dihapus');
    }
}
