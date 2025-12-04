<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisiInstitusi extends Model
{
    protected $table = 'visi_misi_institusis';
    protected $fillable = ['visimisi', 'jenis', 'file_path', 'berlaku_sampai'];
}
