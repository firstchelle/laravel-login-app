<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiInstitusi extends Model
{
    protected $fillable = [
        'misi',
        'file_path',
        'berlaku_sampai',
        'visi_institusi_id',
    ];

    public function visiInstitusi()
    {
        return $this->belongsTo(VisiInstitusi::class);
    }
}
