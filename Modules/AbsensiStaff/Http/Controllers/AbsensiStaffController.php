<?php

namespace Modules\AbsensiStaff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AbsensiStaff\Entities\ModelAbsen;
use Illuminate\Support\Facades\DB;


class AbsensiStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $staff = DB::table('staff')
        ->get();
        return view('absensistaff::index', ['staff' => $staff]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('absensistaff::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */

     public function store(Request $request)
     {
         for ($i=0; $i < count($request->select_absen); $i++) { 
            //  echo $request->id_staff[$i]." ".$request->select_absen[$i]."<br>";
             $this->storeItem($request->select_absen[$i], $request->id_staff[$i]);
         }
         return redirect('/absenstaff');
     }

    public function storeItem($select_absen, $id)
    {
        $absen = ModelAbsen::where("id_staff", "=", $id)->first();
        // echo json_encode($absen);
        // return;
        if ($select_absen == "masuk") {
            if ($absen != null) {
                $absen->masuk = $absen->masuk + 1;
                $absen->save();
            } else {
                $data = DB::table('absensi_staff')->where('id_staff',$id)
                ->insert([
                    'id_staff' => $id,
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
                $data = DB::table('absensi_staff')->where('id_staff',$id)
                ->insert([
                    'id_staff' => $id,
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
                $data = DB::table('absensi_staff')->where('id_staff',$id)
                ->insert([
                    'id_staff' => $id,
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
                $data = DB::table('absensi_staff')->where('id_staff',$id)
                ->insert([
                    'id_staff' => $id,
                    'masuk' => 0,
                    'sakit' => 0,
                    'ijin' => 0,
                    'alfa' => 1
                ]);
            }
        }
        // return redirect('/absenstaff');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $absensistaff = DB::table('absensi_staff')
        ->join('staff', 'absensi_staff.id_staff', '=', 'staff.id_staff')
        ->get();
        return view('absensistaff::show', ['absensistaff' => $absensistaff]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('absensistaff::edit');
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
        return redirect('/absenstaff/show');
    }
}
