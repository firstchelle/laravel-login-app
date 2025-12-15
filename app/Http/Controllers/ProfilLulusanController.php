<?php

namespace App\Http\Controllers;

use App\Models\MisiProdi;
use App\Models\ProfilLulusan;
use App\Models\VisiProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilLulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilLulusans = ProfilLulusan::with(['visiProdi', 'misiProdi'])
            ->latest()
            ->paginate(10);

        return view('profil-lulusan.index', compact('profilLulusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visiList = VisiProdi::all();
        $misiList = MisiProdi::all();

        return view('profil-lulusan.create', compact('visiList', 'misiList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama_dosen_pengisi' => 'required|string|max:255',
            'tanggal_dibuat' => 'required|date',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf|max:5120',
            'profil_lulusan' => 'required|string',
            'deskripsi_profil_lulusan' => 'required|string',
            'visi_prodi_id' => 'required|exists:visi_prodis,id',
            'misi_prodi_id' => 'required|exists:misi_prodis,id',
        ], [
            'nama_dosen_pengisi.required' => 'Nama dosen yang mengisi wajib diisi',
            'tanggal_dibuat.required' => 'Tanggal dibuat wajib diisi',
            'dokumen_pendukung.file' => 'Dokumen pendukung harus berupa file',
            'dokumen_pendukung.mimes' => 'Dokumen pendukung harus berformat PDF',
            'dokumen_pendukung.max' => 'Ukuran dokumen pendukung maksimal 5MB',
            'profil_lulusan.required' => 'Profil lulusan wajib diisi',
            'deskripsi_profil_lulusan.required' => 'Deskripsi profil lulusan wajib diisi',
            'visi_prodi_id.required' => 'Visi prodi wajib dipilih',
            'visi_prodi_id.exists' => 'Visi prodi tidak valid',
            'misi_prodi_id.required' => 'Misi prodi wajib dipilih',
            'misi_prodi_id.exists' => 'Misi prodi tidak valid',
        ]);

        // Handle file upload
        if ($request->hasFile('dokumen_pendukung')) {
            $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('profil-lulusan', 'public');
        }

        ProfilLulusan::create($validated);

        return redirect()->route('profil-lulusan.index')
            ->with('success', 'Profil Lulusan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfilLulusan $profilLulusan)
    {
        $profilLulusan->load(['visiProdi', 'misiProdi']);
        return view('profil-lulusan.show', compact('profilLulusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilLulusan $profilLulusan)
    {
        $visiList = VisiProdi::all();
        $misiList = MisiProdi::all();

        return view('profil-lulusan.edit', compact('profilLulusan', 'visiList', 'misiList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilLulusan $profilLulusan)
    {
        $validated = $request->validate([
            'nama_dosen_pengisi' => 'required|string|max:255',
            'tanggal_dibuat' => 'required|date',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf|max:5120',
            'profil_lulusan' => 'required|string',
            'deskripsi_profil_lulusan' => 'required|string',
            'visi_prodi_id' => 'required|exists:visi_prodis,id',
            'misi_prodi_id' => 'required|exists:misi_prodis,id',
        ], [
            'nama_dosen_pengisi.required' => 'Nama dosen yang mengisi wajib diisi',
            'tanggal_dibuat.required' => 'Tanggal dibuat wajib diisi',
            'dokumen_pendukung.file' => 'Dokumen pendukung harus berupa file',
            'dokumen_pendukung.mimes' => 'Dokumen pendukung harus berformat PDF',
            'dokumen_pendukung.max' => 'Ukuran dokumen pendukung maksimal 5MB',
            'profil_lulusan.required' => 'Profil lulusan wajib diisi',
            'deskripsi_profil_lulusan.required' => 'Deskripsi profil lulusan wajib diisi',
            'visi_prodi_id.required' => 'Visi prodi wajib dipilih',
            'visi_prodi_id.exists' => 'Visi prodi tidak valid',
            'misi_prodi_id.required' => 'Misi prodi wajib dipilih',
            'misi_prodi_id.exists' => 'Misi prodi tidak valid',
        ]);

        // Handle file upload
        if ($request->hasFile('dokumen_pendukung')) {
            // Hapus file lama jika ada
            if ($profilLulusan->dokumen_pendukung && Storage::disk('public')->exists($profilLulusan->dokumen_pendukung)) {
                Storage::disk('public')->delete($profilLulusan->dokumen_pendukung);
            }

            $validated['dokumen_pendukung'] = $request->file('dokumen_pendukung')->store('profil-lulusan', 'public');
        }

        $profilLulusan->update($validated);

        return redirect()->route('profil-lulusan.index')
            ->with('success', 'Profil Lulusan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilLulusan $profilLulusan)
    {
        // Hapus file dokumen jika ada
        if ($profilLulusan->dokumen_pendukung && Storage::disk('public')->exists($profilLulusan->dokumen_pendukung)) {
            Storage::disk('public')->delete($profilLulusan->dokumen_pendukung);
        }

        $profilLulusan->delete();

        return redirect()->route('profil-lulusan.index')
            ->with('success', 'Profil Lulusan berhasil dihapus!');
    }

    /**
     * API untuk mendapatkan misi berdasarkan visi
     */
    public function getMisiByVisi($visiId)
    {
        $misiList = MisiProdi::where('visi_prodi_id', $visiId)->get();
        return response()->json($misiList);
    }
}
