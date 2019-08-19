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
        if ($select_absen == "masuk") {
            $cok = new ModelAbsen();
            $cok->id_staff = $id;
            $cok->masuk = 1;
            $cok->ijin = 0;
            $cok->sakit = 0;
            $cok->alfa = 0;
            $cok->save();
        }elseif ($select_absen == "sakit") {
            $cok = new ModelAbsen();
            $cok->id_staff = $id;
            $cok->masuk = 0;
            $cok->ijin = 0;
            $cok->sakit = 1;
            $cok->alfa = 0;
            $cok->save();
        }elseif ($select_absen == "ijin") {
            $cok = new ModelAbsen();
            $cok->id_staff = $id;
            $cok->masuk = 0;
            $cok->ijin = 1;
            $cok->sakit = 0;
            $cok->alfa = 0;
            $cok->save();
        }elseif ($select_absen == "alfa") {
            $cok = new ModelAbsen();
            $cok->id_staff = $id;
            $cok->masuk = 0;
            $cok->ijin = 0;
            $cok->sakit = 0;
            $cok->alfa = 1;
            $cok->save();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show()
    {
        $absensistaff = DB::table('absensi_staff')
        ->select(DB::raw(' SUM(absensi_staff.masuk) AS masuk,
        SUM(absensi_staff.ijin) AS ijin,
		SUM(absensi_staff.alfa) AS alfa,
        SUM(absensi_staff.sakit) AS sakit,
        absensi_staff.id_absensi_staff, staff.*'))
        ->join('staff', 'absensi_staff.id_staff', '=', 'staff.id_staff')
        ->groupBy('id_staff')
        ->get();
        // dd($absensistaff);
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
