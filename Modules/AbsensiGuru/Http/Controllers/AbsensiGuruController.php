<?php

namespace Modules\AbsensiGuru\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AbsensiGuru\Entities\AbsensiGuru;
use Illuminate\Support\Facades\DB;

class AbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $guru = DB::table('guru')
        ->get();
        return view('absensiguru::index', ['guru' => $guru]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('absensiguru::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
         for ($i=0; $i < count($request->select_absen); $i++) {
             $this->storeItem($request->select_absen[$i], $request->id_guru[$i]);
         }
         return redirect('/absensiguru');
    }
    public function storeItem($select_absen, $id)
    {
        if ($select_absen == "masuk") {
            $cok = new AbsensiGuru();
            $cok->id_guru = $id;
            $cok->masuk = 1;
            $cok->ijin = 0;
            $cok->sakit = 0;
            $cok->alfa = 0;
            $cok->save();
        }elseif ($select_absen == "sakit") {
            $cok = new AbsensiGuru();
            $cok->id_guru = $id;
            $cok->masuk = 0;
            $cok->ijin = 0;
            $cok->sakit = 1;
            $cok->alfa = 0;
            $cok->save();
        }elseif ($select_absen == "ijin") {
            $cok = new AbsensiGuru();
            $cok->id_guru = $id;
            $cok->masuk = 0;
            $cok->ijin = 1;
            $cok->sakit = 0;
            $cok->alfa = 0;
            $cok->save();
        }elseif ($select_absen == "alfa") {
            $cok = new AbsensiGuru();
            $cok->id_guru = $id;
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
        $absensiguru = DB::table('absensi_guru')
        ->select(DB::raw(' SUM(absensi_guru.masuk) AS masuk,
        SUM(absensi_guru.ijin) AS ijin,
		SUM(absensi_guru.alfa) AS alfa,
        SUM(absensi_guru.sakit) AS sakit,
        absensi_guru.id_absensi_guru, guru.*'))
        ->join('guru', 'absensi_guru.id_guru', '=', 'guru.id_guru')
        ->groupBy('id_guru')
        ->get();
        // dd($absensistaff);
        return view('absensiguru::show', ['absensiguru' => $absensiguru]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('absensiguru::edit');
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
        //
    }
}
