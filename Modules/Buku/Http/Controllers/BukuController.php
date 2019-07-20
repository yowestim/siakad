<?php

namespace Modules\Buku\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Buku\Entities\Buku;
use Modules\Buku\Entities\klasifikasi;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index()
    {
        $dataBuku = Buku::join('klasifikasi','klasifikasi.id_klasifikasi', '=', 'buku.id_klasifikasi')->get();
        return view('buku::index', compact('dataBuku'));
    }

    public function add()
    {
        $dataKlasifikasi = DB::table('klasifikasi')->get();
        return view('buku::add', compact('dataKlasifikasi'));
    }

    public function save(Request $request)
    {
        $dataBuku = new Buku();
        $dataBuku->judul_buku = $request->judul_buku;
        $dataBuku->isbn = $request->isbn;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->penerbit = $request->penerbit;
        $dataBuku->tanggal_terbit = $request->tanggal_terbit;
        $dataBuku->id_klasifikasi = $request->klasifikasi;
        $dataBuku->jumlah = $request->jumlah;
        $dataBuku->save();

        return redirect('/buku');
    }

    public function update($id)
    {
        $dataBuku = Buku::find($id);
        $dataKlasifikasi = DB::table('klasifikasi')->get();
        return view('buku::update', compact('dataBuku', 'dataKlasifikasi'));
    }

    public function saveUpdate($id, Request $request)
    {
        $dataBuku = Buku::find($id);
        $dataBuku->judul_buku = $request->judul_buku;
        $dataBuku->isbn = $request->isbn;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->penerbit = $request->penerbit;
        $dataBuku->tanggal_terbit = $request->tanggal_terbit;
        $dataBuku->id_klasifikasi = $request->klasifikasi;
        $dataBuku->jumlah = $request->jumlah;
        $dataBuku->save();

        return redirect('/buku');
    }

    public function delete($id)
    {
        Buku::where('id_buku', $id)->delete();

        return redirect('/buku');
    }

}
