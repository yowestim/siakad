<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{
    //
    public function index()
    {
    	$staff = Staff::all();
    	return view('master.staff.staff', ['staff' => $staff]);
    }
    public function tambah()
    {
    	return view('master.staff.staff_tambah');
    }

    public function save(Request $request)
    {
        $file = $request->file('foto');
        // $filepath = 'img/product/'.'SS'.date('dmY-His').$file->extension();
        $filename = "SS".date('dmY-His').".".$file->extension();
        $file->move('./images/staff/', $filename);

        $staff = new Staff();
        $staff->nama_staff = $request->nama_staff;
        $staff->alamat = $request->alamat;
        $staff->nomor_telepon = $request->nomor_telepon;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        $staff->foto = $filename;
        $staff->save();

        return redirect('/staff');
    }

    public function edit($id)
    {
    $staff = Staff::find($id);
    return view('master.staff.staff_edit', ['staff' => $staff]);
    }

    public function update($id, Request $request)
    {
        $foto = $request->file('foto');
        $foto_old = $request->input('foto_old');

        $staff = Staff::find($id);
        $staff->nama_staff = $request->nama_staff;
        $staff->alamat = $request->alamat;
        $staff->nomor_telepon = $request->nomor_telepon;
        $staff->jenis_kelamin = $request->jenis_kelamin;
        if($foto == ""){

        }else{
            $file = $request->file('foto');
            $filename = "SS".date('dmY-His').".".$file->extension();
            $file->move('./images/staff/', $filename);
            $file_target = './images/staff/';
            unlink($file_target.$foto_old);
        $staff->foto = $filename;
        }
        $staff->save();

        return redirect('/staff');
    }

    public function delete($id)
    {
        $pegawai = Staff::find($id);
        $pegawai->delete();
        return redirect('/staff');
    }
}
