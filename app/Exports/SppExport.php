<?php

namespace App\Exports;

use App\spp;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SppExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('spp')
        ->join('siswa', 'siswa.id_siswa','spp.id_siswa')
        ->select('spp.id_spp','siswa.nama_siswa','spp.bulan','spp.status','spp.jumlah_bayar')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Id',
            'Nama Siswa',
            'Bulan',
            'Status',
            'Jumlah Bayar'
        ];
    }
}
