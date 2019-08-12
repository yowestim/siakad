<?php

namespace Modules\Spp\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Spp\Entities\SppModel as Spp;

class SppController extends Controller
{

    public $bulan = ['Januari',
              'Februari',
              'Maret',
              'April',
              'Mei',
              'Juni',
              'Juli',
              'Agustus',
              'September',
              'Oktober',
              'November',
              'Desember'];

    public function index()
	{
        $spp = DB::table('siswa')
                ->where('id_siswa', 7)
                ->first();

        $spp2 = array();

        foreach($this->bulan as $perbulan) {

            $spp3 = DB::table('spp')
                ->where('id_siswa', 7)
                ->where('bulan', $perbulan)
                ->first();

            if ($spp3 !=null) {
                array_push($spp2, $spp3);
            } else {
                $gkada = (object)[
                               "id_spp"=>0,
                               "bulan"=>$perbulan,
                               "status"=>"B",
                               "id_siswa"=>7,
                               "jumlah_bayar"=>500000];

                array_push($spp2, $gkada);
            }

        }
    	return view('spp::index', ['spp' => $spp,'spp2' => $spp2]);

    }

    public function save(Request $request)
    {

        $file = $request->file('bukti_transaksi');
        $filename = "SS".date('dmY-His').".".$file->extension();
        $file->move('./images/spp/', $filename);

        $id = $request->idspp;
        $spp = new Spp();
        $spp->jumlah_bayar = 500000;
        $spp->bulan = $request->bulan;
        $spp->id_siswa = 7;
        $spp->status = $request->status;
        $spp->bukti_transaksi = $filename;
        $spp->save();

        return Redirect('spp');
    }

    public function admin(Request $request)
    {
        // Di BAWAH INI FUNCTION UNTUK MEMANGGIL DATA DARI TABEL LAIN (JOIN)
        $adminspp = DB::table('spp')
                    ->join('siswa', 'siswa.id_siswa','spp.id_siswa')
                    ->select('spp.*','siswa.nama_siswa', 'siswa.jenis_kelamin', 'siswa.alamat')
                    ->get();
                    if($request->tgl_awal == "" || $request->tgl_akhir == ""){
                        $tgl_awal = "";
                        $tgl_akhir = "";
                        $spp = DB::table('spp')
                                    ->select(
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 1 THEN 1 ELSE 0 END ) ) AS `Januari` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 2 THEN 1 ELSE 0 END ) ) AS `Februari` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 3 THEN 1 ELSE 0 END ) ) AS `Maret` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 4 THEN 1 ELSE 0 END ) ) AS `April` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 5 THEN 1 ELSE 0 END ) ) AS `Mei` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 6 THEN 1 ELSE 0 END ) ) AS `Juni` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 7 THEN 1 ELSE 0 END ) ) AS `Juli` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 8 THEN 1 ELSE 0 END ) ) AS `Agustus` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 9 THEN 1 ELSE 0 END ) ) AS `September` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 10 THEN 1 ELSE 0 END ) ) AS `Oktober` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 11 THEN 1 ELSE 0 END ) ) AS `November` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 12 THEN 1 ELSE 0 END ) ) AS `Desember` '),
                                            )
                                    // ->whereYear('created_at', now())
                                    ->first();
                                    // dd($spp);
                            return view('spp::admin_spp', ['adminspp' => $adminspp, 'chart' => $spp, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);

                           }else {
                            $tgl_awal = $request->tgl_awal;
                            $tgl_akhir = $request->tgl_akhir;
                            $spp = DB::table('spp')
                                    ->select(
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 1 THEN 1 ELSE 0 END ) ) AS `Januari` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 2 THEN 1 ELSE 0 END ) ) AS `Februari` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 3 THEN 1 ELSE 0 END ) ) AS `Maret` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 4 THEN 1 ELSE 0 END ) ) AS `April` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 5 THEN 1 ELSE 0 END ) ) AS `Mei` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 6 THEN 1 ELSE 0 END ) ) AS `Juni` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 7 THEN 1 ELSE 0 END ) ) AS `Juli` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 8 THEN 1 ELSE 0 END ) ) AS `Agustus` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 9 THEN 1 ELSE 0 END ) ) AS `September` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 10 THEN 1 ELSE 0 END ) ) AS `Oktober` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 11 THEN 1 ELSE 0 END ) ) AS `November` '),
                                            DB::raw('sum( ( CASE MONTH ( `spp`.`created_at` ) WHEN 12 THEN 1 ELSE 0 END ) ) AS `Desember` '),
                                            )
                                    ->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                                    ->first();
                                    return view('spp::admin_spp', ['adminspp' => $adminspp, 'chart' => $spp, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
                        }
    }

    public function saveAdmin(Request $request)
    {
        $id_spp = $request->id_spp;
        $spp = Spp::find($id_spp);
        $spp->status = $request->status;

        $spp->save();

        return redirect('/adminspp');
    }

    public function search(Request $request){
        $search = DB::table('spp')
                ->join('siswa', 'siswa.id_siswa','spp.id_siswa')
                ->select('spp.*','siswa.nama_siswa', 'siswa.jenis_kelamin', 'siswa.alamat')
                ->where('siswa.id_siswa', $request->q)
                ->get();
                // dd($search);
        // return view('search', compact('search'));
        return view('spp::admin_spp',['adminspp' => $search]);
     }

     public function cetak_pdf()
     {
         $spp = DB::table('spp')
             ->join('siswa', 'siswa.id_siswa','spp.id_siswa')
             ->select('spp.*','siswa.nama_siswa')
             ->get();

         $pdf = PDF::loadview('staff::spp_pdf',['spp'=>$spp]);
         return $pdf->download('laporan-spp-pdf.pdf');
     }

     public function cetak_excel()
     {
         return Excel::download(new SppExport, 'Laporan-Spp-Excel.xlsx');
     }
}
