<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';
    protected $fillable = [
        'uts', 'uas', 'harian', 'hasil_akhir','id_siswa',
    ];
}
