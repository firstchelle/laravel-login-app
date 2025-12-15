<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilLulusan extends Model
{
    protected $table = 'profil_lulusans';

    protected $fillable = [
        'nama_dosen_pengisi',
        'tanggal_dibuat',
        'dokumen_pendukung',
        'profil_lulusan',
        'deskripsi_profil_lulusan',
        'visi_prodi_id',
        'misi_prodi_id',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'date',
    ];

    public function visiProdi()
    {
        return $this->belongsTo(VisiProdi::class, 'visi_prodi_id');
    }

    public function misiProdi()
    {
        return $this->belongsTo(MisiProdi::class, 'misi_prodi_id');
    }
}
