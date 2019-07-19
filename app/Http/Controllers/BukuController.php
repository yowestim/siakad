<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $dataBuku = Buku::all();
    	return view('master.buku.buku', ['buku' => $dataBuku]);
    }

    public function addBuku()
    {
    	return view('master.buku.buku_add');
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

        return redirect('/staff');
    }
}
