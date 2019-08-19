<?php

namespace Modules\AbsensiMurid\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AbsensiMurid\Entities\ModelAbsen;
use DB;

class AbsensiMuridController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $siswa = DB::table('siswa')
        ->leftjoin('absensi_siswa', 'absensi_siswa.id_siswa' , '=', 'siswa.id_siswa')
        ->leftjoin('kelas', 'kelas.id_kelas' , '=', 'siswa.id_kelas')
        ->select('siswa.*', 'absensi_siswa.masuk', 'absensi_siswa.sakit', 'absensi_siswa.ijin', 'absensi_siswa.alfa', 'kelas.nama_kelas')
        ->get();
        return view('absensimurid::index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('absensimurid::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        for ($i=0; $i < count($request->select_absen); $i++) { 
             $this->storeItem($request->select_absen[$i], $request->id_siswa[$i]);
         }
         return redirect('/absensiswa');
    }

    public function storeItem($select_absen, $id)
    {

        $absen = ModelAbsen::where("id_siswa", "=", $id)->first();
        // echo json_encode($absen);
        // return;
        if ($select_absen == "masuk") {
            if ($absen != null) {
                $absen->masuk = $absen->masuk + 1;
                $absen->save();
            } else {
                $data = DB::table('absensi_siswa')->where('id_siswa',$id)
                ->insert([
                    'id_siswa' => $id,
                    'masuk' => 1,
                    'sakit' => 0,
                    'ijin' => 0,
                    'alfa' => 0
                ]);
            }
        }elseif ($select_absen == "sakit") {
            if ($absen != null) {
                $absen->sakit = $absen->sakit + 1;
                $absen->save();
            } else {
                $data = DB::table('absensi_siswa')->where('id_siswa',$id)
                ->insert([
                    'id_siswa' => $id,
                    'masuk' => 0,
                    'sakit' => 1,
                    'ijin' => 0,
                    'alfa' => 0
                ]);
            }
        }elseif ($select_absen == "ijin") {
            if ($absen != null) {
                $absen->ijin = $absen->ijin + 1;
                $absen->save();
            } else {
                $data = DB::table('absensi_siswa')->where('id_siswa',$id)
                ->insert([
                    'id_siswa' => $id,
                    'masuk' => 0,
                    'sakit' => 0,
                    'ijin' => 1,
                    'alfa' => 0
                ]);
            }
        }elseif ($select_absen == "alfa") {
            if ($absen != null) {
                $absen->alfa = $absen->alfa + 1;
                $absen->save();
            } else {
                $data = DB::table('absensi_siswa')->where('id_siswa',$id)
                ->insert([
                    'id_siswa' => $id,
                    'masuk' => 0,
                    'sakit' => 0,
                    'ijin' => 0,
                    'alfa' => 1
                ]);
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $absensimurid = DB::table('absensi_siswa')
        ->join('siswa', 'absensi_siswa.id_siswa', '=', 'siswa.id_siswa')
        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->get();
        return view('absensimurid::show', ['absensimurid' => $absensimurid]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('absensimurid::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $absen = ModelAbsen::find($id);
        $absen->delete();
        return redirect('/absensiswa/show');
    }
}
