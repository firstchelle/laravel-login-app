<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiFakultas extends Model
{
    protected $table = 'visi_fakultas';

    protected $fillable = [
        'visi',
        'file_path',
        'berlaku_sampai'
    ];

    public function misiFakultas()
    {
        return $this->hasMany(MisiFakultas::class);
    }
}
