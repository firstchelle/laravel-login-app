<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisiInstitusi extends Model
{
    protected $table = 'visi_misi_institusis';
    protected $fillable = ['visimisi', 'jenis', 'file_path', 'berlaku_sampai', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(VisiMisiInstitusi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(VisiMisiInstitusi::class, 'parent_id');
    }
}
