<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spp;
use DB;
use Charts;

class SppController extends Controller
{
    public function index()
    {
        // $spp = Spp::all();
        $spp = DB::table('spp')
            ->join('siswa','siswa.id_siswa','spp.id_siswa')
            ->select('spp.*','siswa.nama_siswa')
            ->get();

        $spp_chart = Spp::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->get();
            // dd($spp_chart);
        $chart = Charts::database($spp_chart, 'bar', 'highcharts')
                ->title("Monthly new Register Users")
                ->elementLabel("Total Users")
                ->dimensions(1000, 500)
                ->responsive(false)
                ->groupByMonth(date('Y'), true);

    	return view('master.spp.spp', ['spp' => $spp, 'chart' => $chart]);
    }
}
