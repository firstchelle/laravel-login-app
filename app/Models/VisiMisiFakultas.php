<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisiFakultas extends Model
{
    protected $table = 'visi_misi_fakultas';
    protected $fillable = ['visimisi', 'jenis', 'file_path', 'berlaku_sampai', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(VisiMisiFakultas::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(VisiMisiFakultas::class, 'parent_id');
    }
}
