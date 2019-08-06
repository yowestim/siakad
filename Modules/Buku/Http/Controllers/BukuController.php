<?php

namespace Modules\Buku\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Buku\Entities\Buku;

class BukuController extends Controller
{
    public function index()
    {
        return view('buku::index');
    }

    public function add()
    {
        return view('buku::add');
    }

    public function save(Request $request)
    {
        $dataBuku = new Buku();
        $dataBuku->judul_buku = $request->judul_buku;
        $dataBuku->isbn = $request->isbn;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_terbit = $request->tanggal_terbit;
        $dataBuku->id_klasifikasi = $request->klasifikasi;
        $dataBuku->jumlah = $request->jumlah;
        $dataBuku->save();
    }

}
