<?php

namespace Modules\TransaksiPeminjamanBuku\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TransaksiPeminjamanBuku\Entities\TransaksiPeminjamanBuku;
use Modules\Buku\Entities\Buku;
use DateTime;
use DB;

class TransaksiPeminjamanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $gatel = DB::table('transaksi_pinjaman')
        ->join('buku', 'buku.id_buku', '=', 'transaksi_pinjaman.id_buku')
        ->join('siswa', 'siswa.id_siswa', '=', 'transaksi_pinjaman.id_siswa')
        ->get();
        return view('transaksipeminjamanbuku::index', compact('gatel'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('transaksipeminjamanbuku::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('transaksipeminjamanbuku::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('transaksipeminjamanbuku::edit');
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
    public function kembali(Request $request , $id){
        $asu = Buku::find($request->idbuku);
        $asu->jumlah = $asu->jumlah + 1;
        $asu->save();
        $cok = TransaksiPeminjamanBuku::find($id);
        $cok->status = "K";
            $date1=new DateTime(date('Y-m-d', strtotime($cok->tanggal_dikembalikan)));
            $date2=new DateTime(date('Y-m-d', strtotime(date("Y-m-d"))));
            if($date1 < $date2) {
                $diff = $date1->diff($date2)->days; 
                $denda = $diff*10000; 
            }
        $cok->denda = $denda;
        $cok->save();
        return redirect('/tpb');
    }
    public function bayarDenda($id){
        $kont = TransaksiPeminjamanBuku::find($id);
        $kont->denda = 0;
        $kont->save();
        return redirect('/tpb');
    }
    public function delete($id)
    {
        $cok = TransaksiPeminjamanBuku::find($id);
        $cok->delete();
        return redirect('/tpb');

    }
}
