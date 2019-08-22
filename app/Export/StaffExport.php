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
        return DB::table('absensi_staff')
        ->join('staff','staff.id_staff','absensi_staff.id_staff')
        // ->select('staff.nama_staff','absensi_staff.ijin','absensi_staff.alfa',
        // 'absensi_staff.sakit','absensi_staff.masuk')
        ->select('staff.nama_staff', 
                DB::raw('SUM(absensi_staff.ijin) as ijin'),
                DB::raw('SUM(absensi_staff.alfa) as alfa'),
                DB::raw('SUM(absensi_staff.sakit) as sakit'),
                DB::raw('SUM(absensi_staff.masuk) as masuk'))    
        ->groupby('staff.nama_staff')
        ->get();
    }
    public function headings(): array
    {
        return [        
            'Nama staff',
            'ijin',
            'alfa',
            'sakit',
            'masuk'
        ];
    }
}