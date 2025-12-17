<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiInstitusi extends Model
{
    protected $table = 'visi_institusis';

    protected $fillable = [
        'visi',
        'file_path',
        'berlaku_sampai'
    ];

    public function misiInstitusi()
    {
        return $this->hasMany(MisiInstitusi::class);
    }
}
