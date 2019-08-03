<?php

namespace Modules\TransaksiPeminjamanBuku\Entities;

use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjamanBuku extends Model
{
    protected $table = 'transaksi_pinjaman';
    protected $primaryKey = 'id_transaksi_pinjaman';
}
