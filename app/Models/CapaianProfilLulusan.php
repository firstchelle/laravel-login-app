<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianProfilLulusan extends Model
{
    protected $table = 'capaian_profil_lulusans';

    protected $fillable = [
        'nama_dosen_pengisi',
        'tanggal_dibuat',
        'dokumen_pendukung',
        'capaian_profil_lulusan',
        'deskripsi_capaian_profil_lulusan',
        'profil_lulusan_id',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'date',
    ];

    /**
     * Each capaian belongs to one profil lulusan.
     */
    public function profilLulusan()
    {
        return $this->belongsTo(ProfilLulusan::class, 'profil_lulusan_id');
    }
}
