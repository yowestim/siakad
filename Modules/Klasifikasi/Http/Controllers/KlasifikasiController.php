<?php

namespace Modules\Klasifikasi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Klasifikasi\Entities\Klasifikasi;
use Redirect;
class KlasifikasiController extends Controller
{
    public function index()
    {
        $klasifikasi = Klasifikasi::all();
        return view('klasifikasi::index', ['klasifikasi' => $klasifikasi]);
    }
    public function save(Request $request)
    {
        $klasifikasi = new Klasifikasi();
        $klasifikasi->nama_klasifikasi = $request->nama_klasifikasi;
        $klasifikasi->save();

        return Redirect::to('klasifikasi');
    }

    public function update($id, Request $request)
    {
        $klasifikasi = Klasifikasi::find($id);
        $klasifikasi->nama_klasifikasi = $request->nama_klasifikasi;
        $klasifikasi->save();

        return Redirect::to('klasifikasi');
    }

    public function delete($id)
    {
        $klasifikasi = Klasifikasi::find($id);
        $klasifikasi->delete();
        return Redirect::to('klasifikasi');
    }
}
