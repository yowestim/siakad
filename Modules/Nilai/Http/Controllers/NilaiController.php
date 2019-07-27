<?php

namespace Modules\Nilai\Http\Controllers;

use App\Nilai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $dataNilai = DB::table('nilai') 
    
        ->join('siswa', 'siswa.id_siswa', '=', 'nilai.id_siswa')
        ->select('nilai.*', 'siswa.nama_siswa')
        ->get();
        
        return view('nilai::index', compact('dataNilai'));
    }

    public function add()
    {
        // $dataKlasifikasi = DB::table('klasifikasi')->get();
        $dataSiswa = DB::table('siswa') ->get();
        return view('nilai::add',compact('dataSiswa'));
    }

    public function save(Request $request)
    {
        //dd($request->siswa);
        Nilai::create([
            'uts' => $request->uts,
            'uas' => $request->uas,
            'harian' => $request->harian,
            'hasil_akhir' => $request->hasil_akhir,
            'id_siswa' => $request->siswa,
        ]);

        return redirect('/nilai');
    }

    public function update($id)
    {
        $dataNilai = Nilai::find($id);
        $dataKlasifikasi = DB::table('klasifikasi')->get();
        return view('nilai::update', compact('dataNilai', 'dataKlasifikasi'));
    }

    public function saveUpdate($id, Request $request)
    {
        $dataNilai = Nilai::find($id);
        $dataNilai->uts = $request->uts;
        $dataNilai->uas = $request->uas;
        $dataNilai->harian = $request->harian;
        $dataNilai->hasil_akhir = $request->hasil_akhir;
        $dataNilai->save();

        return redirect('/nilai');
    }

    public function delete($id)
    {
        Nilai::where('id_nilai', $id)->delete();

        return redirect('/nilai');
    }
}
