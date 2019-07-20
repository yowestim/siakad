<?php

namespace Modules\AbsensiMurid\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelAbsen extends Model
{
    protected $table = "absensi_siswa";
    protected $primaryKey = "id_absensi_siswa";
}