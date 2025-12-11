<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisiProdi extends Model
{
    protected $table = 'visi_misi_prodis';
    protected $fillable = ['visimisi', 'jenis', 'file_path', 'berlaku_sampai', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(VisiMisiProdi::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(VisiMisiProdi::class, 'parent_id');
    }
}
