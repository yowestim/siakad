<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\Staff;
use DB;
use PDF;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SppExport;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index(Request $request)
    {
        $staff = Staff::all();
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
            return view('staff::index', ['staff' => $staff, 'chart' => $spp, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);

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
                    return view('staff::index', ['staff' => $staff, 'chart' => $spp, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
        }

    }
    public function tambah()
    {
    	return view('staff::staff_tambah');
    }

    public function save(Request $request)
    {
        $file = $request->file('foto');
        // $filepath = 'img/product/'.'SS'.date('dmY-His').$file->extension();
        $filename = "SS".date('dmY-His').".".$file->extension();
        $file->move('./images/staff/', $filename);

        $staff = new Staff();
        $staff->nama_staff = $request->nama_staff;
        $staff->alamat = $request->alamat;
        $staff->nomor_telepon = $request->nomor_telepon;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        $staff->foto = $filename;
        $staff->save();

        return redirect('/staff');
    }

    public function edit($id)
    {
    $staff = Staff::find($id);
    return view('staff::staff_edit', ['staff' => $staff]);
    }

    public function update($id, Request $request)
    {
        $foto = $request->file('foto');
        $foto_old = $request->input('foto_old');

        $staff = Staff::find($id);
        $staff->nama_staff = $request->nama_staff;
        $staff->alamat = $request->alamat;
        $staff->nomor_telepon = $request->nomor_telepon;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        if($foto == ""){

        }else{
            $file = $request->file('foto');
            $filename = "SS".date('dmY-His').".".$file->extension();
            $file->move('./images/staff/', $filename);
            $file_target = './images/staff/';
            unlink($file_target.$foto_old);
        $staff->foto = $filename;
        }
        $staff->save();

        return redirect('/staff');
    }

    public function delete($id)
    {
        $pegawai = Staff::find($id);
        $pegawai->delete();
        return redirect('/staff');
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
