<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiProdi extends Model
{
    protected $table = 'visi_prodis';

    protected $fillable = [
        'visi',
        'file_path',
        'berlaku_sampai'
    ];

    public function misiProdis()
    {
        return $this->hasMany(MisiProdi::class);
    }

    public function profilLulusans()
    {
        return $this->hasMany(ProfilLulusan::class, 'visi_prodi_id');
    }
}
