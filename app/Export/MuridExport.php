<?php

namespace App\Export;

use App\spp;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MuridExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    public function collection()
    {
        return DB::table('absensi_siswa')
        ->join('siswa','siswa.id_siswa','absensi_siswa.id_siswa')
        // ->select('siswa.nama_siswa','absensi_siswa.ijin','absensi_siswa.alfa',
        // 'absensi_siswa.sakit','absensi_siswa.masuk')
        ->select('siswa.nama_siswa', 
                DB::raw('SUM(absensi_siswa.ijin) as ijin'),
                DB::raw('SUM(absensi_siswa.alfa) as alfa'),
                DB::raw('SUM(absensi_siswa.sakit) as sakit'),
                DB::raw('SUM(absensi_siswa.masuk) as masuk'))    
        ->groupby('siswa.nama_siswa')
        ->get();
    }
    public function headings(): array
    {
        return [        
            'Nama Siswa',
            'ijin',
            'alfa',
            'sakit',
            'masuk'
        ];
    }
}