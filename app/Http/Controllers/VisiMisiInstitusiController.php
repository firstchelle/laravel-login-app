<?php

namespace App\Http\Controllers;

use App\Models\VisiInstitusi;
use App\Models\MisiInstitusi;
use Illuminate\Http\Request;

class VisiMisiInstitusiController extends Controller
{
    public function index()
    {
        $data_visi = VisiInstitusi::with('misi')->get();
        $data_misi = MisiInstitusi::with('visi')->get();

        return view('visi.institusi.index', compact('data_visi', 'data_misi'));
    }

    // === CREATE VISI ===
    public function create()
    {
        $data_visi = VisiInstitusi::all();
        return view('visi.institusi.createvisiinstitusi', compact('data_visi'));
    }

    // === STORE VISI / MISI ===
    public function store(Request $request)
    {
        if ($request->has('isi_visi')) {
            // Simpan Visi
            $validated = $request->validate([
                'isi_visi' => 'required|string|max:1500',
                'author' => 'required|string|max:255',
                'dokumen' => 'nullable|file|mimes:pdf',
                'berlaku_sampai' => 'nullable|date',
            ]);

            if ($request->hasFile('dokumen')) {
                $validated['dokumen_pendukung'] = $request->file('dokumen')->store('dokumen', 'public');
            }

            VisiInstitusi::create([
                'isi_visi' => $validated['isi_visi'],
                'author' => $validated['author'],
                'dokumen_pendukung' => $validated['dokumen_pendukung'] ?? null,
                'berlaku_sampai' => $validated['berlaku_sampai'] ?? null,
            ]);

            return redirect()->route('visiinstitusi.index')->with('success', 'Visi berhasil ditambahkan');
        }

        if ($request->has('isi_misi')) {
            // Simpan Misi
            $validated = $request->validate([
                'isi_misi' => 'required|string|max:1500',
                'author' => 'required|string|max:255',
                'id_visi' => 'required|exists:visi_institusi,id_visi',
                'dokumen_pendukung' => 'nullable|file|mimes:pdf',
            ]);

            if ($request->hasFile('dokumen_pendukung')) {
                $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('dokumen', 'public');
            }

            MisiInstitusi::create([
                'isi_misi' => $validated['isi_misi'],
                'author' => $validated['author'],
                'id_visi' => $validated['id_visi'],
                'dokumen_pendukung' => $validated['dokumen_pendukung'] ?? null,
            ]);

            return redirect()->route('visiinstitusi.index')->with('success', 'Misi berhasil ditambahkan');
        }

        return redirect()->route('visiinstitusi.index')->with('error', 'Tidak ada data yang dikirim');
    }

    // === EDIT / UPDATE / DELETE VISI ===
    public function edit($id)
    {
        $visi = VisiInstitusi::findOrFail($id);
        return view('visi.institusi.editvisiinstitusi', compact('visi'));
    }

    public function update(Request $request, $id)
    {
        $visi = VisiInstitusi::findOrFail($id);

        $validated = $request->validate([
            'isi_visi' => 'required|string|max:1500',
            'author' => 'required|string|max:255',
            'dokumen' => 'nullable|file|mimes:pdf',
            'berlaku_sampai' => 'nullable|date',
        ]);

        if ($request->hasFile('dokumen')) {
            $validated['dokumen_pendukung'] = $request->file('dokumen')->store('dokumen', 'public');
        }

        $visi->update([
            'isi_visi' => $validated['isi_visi'],
            'author' => $validated['author'],
            'dokumen_pendukung' => $validated['dokumen_pendukung'] ?? $visi->dokumen_pendukung,
            'berlaku_sampai' => $validated['berlaku_sampai'] ?? $visi->berlaku_sampai,
        ]);

        return redirect()->route('visiinstitusi.index')->with('success', 'Visi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $visi = VisiInstitusi::findOrFail($id);
        $visi->delete();

        return redirect()->route('visiinstitusi.index')->with('success', 'Visi berhasil dihapus');
    }

    // === CREATE MISI ===
    public function createMisi()
    {
        $data_visi = VisiInstitusi::all();
        return view('visi.institusi.createmisiinstitusi', compact('data_visi'));
    }

    public function editMisi($id)
{
    $misi = MisiInstitusi::findOrFail($id);
    $data_visi = VisiInstitusi::all();
    return view('visi.institusi.editmisiinstitusi', compact('misi', 'data_visi'));
}

public function updateMisi(Request $request, $id)
{
    $misi = MisiInstitusi::findOrFail($id);

    $validated = $request->validate([
        'isi_misi' => 'required|string|max:1500',
        'author' => 'required|string|max:255',
        'id_visi' => 'required|exists:visi_institusi,id_visi',
        'dokumen_pendukung' => 'nullable|file|mimes:pdf',
    ]);

    if ($request->hasFile('dokumen_pendukung')) {
        $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('dokumen', 'public');
    }

    $misi->update($validated);

    return redirect()->route('visiinstitusi.index')->with('success', 'Misi berhasil diperbarui');
}

public function destroyMisi($id)
{
    $misi = MisiInstitusi::findOrFail($id);
    $misi->delete();

    return redirect()->route('visiinstitusi.index')->with('success', 'Misi berhasil dihapus');
}
}