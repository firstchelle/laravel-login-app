<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiProdi extends Model
{
    protected $fillable = [
        'misi',
        'file_path',
        'berlaku_sampai',
        'visi_prodi_id',
    ];

    public function visiProdi()
    {
        return $this->belongsTo(VisiProdi::class);
    }

    public function profilLulusans()
    {
        return $this->hasMany(ProfilLulusan::class, 'misi_prodi_id');
    }
}
