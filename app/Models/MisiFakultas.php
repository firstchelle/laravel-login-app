<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiFakultas extends Model
{
    protected $fillable = [
        'misi',
        'file_path',
        'berlaku_sampai',
        'visi_fakultas_id',
    ];

    public function visiFakultas()
    {
        return $this->belongsTo(VisiFakultas::class);
    }
}
