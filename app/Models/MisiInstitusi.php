<?php
// app/Models/MisiInstitusi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiInstitusi extends Model {
    protected $table = 'misi_institusi';
    protected $primaryKey = 'id_misi';
    protected $fillable = ['isi_misi','author','id_visi'];

    public function visi() {
        return $this->belongsTo(VisiInstitusi::class, 'id_visi');
    }
}

