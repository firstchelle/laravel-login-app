<?php
// app/Models/VisiInstitusi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiInstitusi extends Model {
    protected $table = 'visi_institusi';
    protected $primaryKey = 'id_visi';
    protected $fillable = ['isi_visi','author','dokumen_pendukung','berlaku_sampai'];

    public function misi() {
        return $this->hasMany(MisiInstitusi::class, 'id_visi');
    }
}
