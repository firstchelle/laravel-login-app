<?php

namespace App\Http\Controllers;

use App\Models\MisiProdi;
use Illuminate\Http\Request;
use App\Models\VisiProdi; // <-- WAJIB TAMBAHKAN
use Illuminate\Support\Facades\Storage;

class VisiMisiProdiController extends Controller
{
    /**
     * Semua fungsi untuk CRUD VISI
     */
    public function index()
    {
        $visi = VisiProdi::all();
        $misi = MisiProdi::all();

        return view('visi.prodi', compact('visi', 'misi'));
    }

    public function create_visi()
    {
        return view('visi.prodi.create_visi');
    }

    public function edit_visi($id)
    {
        $item = VisiProdi::findOrFail($id);
        return view('visi.prodi.edit_visi', compact('item'));
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

        VisiProdi::create([
            'visi' => $request->visi,
            'file_path' => $path,
            'berlaku_sampai' => $request->input('berlaku_sampai'),
        ]);

        return redirect()->route('visiprodi.index');
    }

    public function update_visi(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        $item = VisiProdi::findOrFail($id);

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

        return redirect()->route('visiprodi.index');
    }

    public function hapus_visi($id)
    {
        $item = VisiProdi::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();
        return redirect()->route('visiprodi.index');
    }

    /**
     * Semua fungsi untuk CRUD VISI
     */

    public function create_misi()
    {
        $visi = VisiProdi::all();
        return view('visi.prodi.create_misi', compact('visi'));
    }

    public function edit_misi($id)
    {
        $item = MisiProdi::findOrFail($id);
        $visi = VisiProdi::all();

        return view('visi.prodi.edit_misi', compact('item', 'visi'));
    }

    public function store_misi(Request $request)
    {
        $request->validate([
            'visi_prodi_id' => 'required|exists:visi_prodis,id',
            'misi' => 'required|string',
            'berlaku_sampai' => 'nullable|date',
        ]);

        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen', 'public');
        } else {
            $path = null;
        }

        MisiProdi::create([
            'visi_prodi_id' => $request->visi_prodi_id,
            'misi' => $request->misi,
            'file_path' => $path,
            'berlaku_sampai' => $request->input('berlaku_sampai'),
        ]);

        return redirect()->route('visiprodi.index');
    }

    public function update_misi(Request $request, $id)
    {
        $request->validate([
            'visi_prodi_id' => 'required|exists:visi_prodis,id',
            'misi' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf|max:5120',
            'berlaku_sampai' => 'required|date',
        ], [
            'visi_prodi_id.required' => 'Visi harus dipilih',
            'visi_prodi_id.exists' => 'Visi yang dipilih tidak valid',
            'misi.required' => 'Misi harus diisi',
            'berlaku_sampai.required' => 'Tanggal berlaku sampai harus diisi',
        ]);

        $misi = MisiProdi::findOrFail($id);

        $data = [
            'visi_prodi_id' => $request->visi_prodi_id,
            'misi' => $request->misi,
            'berlaku_sampai' => $request->berlaku_sampai,
        ];

        if ($request->hasFile('dokumen')) {
            if ($misi->file_path && Storage::disk('public')->exists($misi->file_path)) {
                Storage::disk('public')->delete($misi->file_path);
            }

            $data['file_path'] = $request->file('dokumen')->store('misi-prodi', 'public');
        }

        $misi->update($data);

        return redirect()->route('visiprodi.index')
            ->with('success', 'Misi berhasil diperbarui');
    }

    public function hapus_misi($id)
    {
        $item = MisiProdi::findOrFail($id);

        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }

        $item->delete();

        return redirect()->route('visiprodi.index')
            ->with('success', 'Misi berhasil dihapus');
    }

    // public function create()
    // {
    //     $data_misi = VisiMisiProdi::where('jenis', 'misi')->get();
    //     return view('visi.prodi.createvisiprodi', compact('data_misi'));
    // }

    // // public function edit($id)
    // // {
    // //     $item = VisiMisiProdi::with('children')->findOrFail($id);
    // //     $data_misi = VisiMisiProdi::where('jenis', 'misi')->get(); // semua misi
    // //     return view('visi.prodi.editvisiprodi', compact('item', 'data_misi'));
    // // }

    // public function update(Request $request, $id)
    // {
    //     $validate = $request->validate([
    //         'visimisi' => 'required|string',
    //         'jenis' => 'required|in:visi,misi',
    //         'dokumen' => 'nullable|mimes:pdf|max:2048',
    //         'berlaku_sampai' => 'nullable|date',
    //         'misi_ids' => 'nullable|array',
    //     ]);

    //     $item = VisiMisiProdi::findOrFail($id);

    //     // Perbarui file
    //     if ($request->hasFile('dokumen')) {

    //         if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
    //             Storage::disk('public')->delete($item->file_path);
    //         }

    //         $path = $request->file('dokumen')->store('dokumen', 'public');
    //         $validate['file_path'] = $path;
    //     }

    //     // Update data utama
    //     $item->update($validate);

    //     VisiMisiProdi::where('parent_id', $id)->update(['parent_id' => null]);

    //     if ($request->filled('misi_ids')) {
    //         VisiMisiProdi::whereIn('id', $request->misi_ids)
    //             ->update(['parent_id' => $id]);
    //     }

    //     return redirect()->route('visiprodi.index');
    // }

    // public function destroy($id)
    // {
    //     $item = VisiMisiProdi::findOrFail($id);

    //     if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
    //         Storage::disk('public')->delete($item->file_path);
    //     }

    //     $item->delete();
    //     return redirect()->route('visiprodi.index');
    // }

    // public function storeMisiAjax(Request $request)
    // {
    //     $validate = $request->validate([
    //         'visimisi' => 'required|string',
    //     ]);

    //     $data = VisiMisiProdi::create([
    //         'visimisi' => $validate['visimisi'],
    //         'jenis' => 'misi'
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $data
    //     ]);
    // }

    // public function getAllMisi()
    // {
    //     return VisiMisiProdi::where('jenis', 'misi')
    //         ->select('id', 'visimisi')
    //         ->get();
    // }
}
