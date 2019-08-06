<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\Role;
use Modules\Auth\Entities\Guru;
use Modules\Auth\Entities\Siswa;
use Modules\Auth\Entities\Staff;
use Modules\Buku\Entities\Buku;
use Redirect;
use Session;
use Alert;
use Hash;
use DB;

class AuthController extends Controller
{
    public function loginstaff()
    {
        return view('auth::login.loginstaff');
    }
    public function loginnguru()
    {
        return view('auth::login.loginguru');
    }
    public function loginsiswa()
    {
        return view('auth::login.loginsiswa');
    }
    public function loginPoststaff(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $data = DB::table('user')
        ->join('staff','staff.id_staff','user.id_staff')
        ->where('username',$username)
        ->first();
        if($data){
            if(Hash::check($password,$data->password)){
                Session::put('username',$data->username);
                Session::put('id_user',$data->id_user);
                Session::put('id_roles',$data->id_roles);
                Session::put('id_staff',$data->id_staff);
                Session::put('login',true);
                echo 1;
            }else{
                echo 0;
            }
        }else{
            return redirect('/loginstaff');
        }
    }

    public function loginPostguru(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $data = DB::table('user')
        ->join('guru','guru.id_guru','user.id_guru')
        ->where('username',$username)
        ->first();
            if($data){
            if(Hash::check($password,$data->password)){
                Session::put('username',$data->username);
                Session::put('id_guru',$data->id_guru);
                Session::put('id_roles',$data->id_roles);
                Session::put('nama_guru',$data->nama_guru);
                Session::put('login',true);
                echo 1;
            }else{
                echo 0;
            }
        }else{
            return redirect('/loginguru');
        }
    }

    public function loginPostsiswa(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $data = DB::table('user')
        ->join('siswa','siswa.id_siswa','user.id_siswa')
        ->where('username',$username)
        ->first();
        if($data){
            if(Hash::check($password,$data->password)){
                Session::put('username',$data->username);
                Session::put('id_user',$data->id_user);
                Session::put('id_roles',$data->id_roles);
                Session::put('id_siswa',$data->id_siswa);
                Session::put('login',true);
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
            return redirect('/loginsiswa');
        }
    }

    public function registrasi()
    {
        $data = DB::table('roles')->get();
        $kelas = DB::table('kelas')->get();
        // dd($data);
        return view('auth::registrasi',compact('data','kelas'));
    }

    public function registrasiPost(Request $request)
    {
        $dataUser = new User;
        if ($request->roles == '1' || $request->roles == '2' || $request->roles == '3' || $request->roles == '6') {
            $dataStaff = new Staff;
            $dataStaff->nama_staff = $request->namee;
            $dataStaff->alamat = $request->addresss;
            $dataStaff->nomor_telepon = $request->nomorr;
            $dataStaff->jenis_kelamin = $request->jk;
            $dataStaff->save();

            $dataUser->username = $request->usernamee;
            $dataUser->password = bcrypt($request->passwordd);
            $dataUser->id_staff = $dataStaff->id_staff;
            $dataUser->id_roles = $request->roles;  
            $dataUser->id_staff = $dataStaff->id;
            $dataUser->save();
            return redirect('loginstaff');
            
        }else if($request->roles == '4'){
            $dataGuru = new Guru;
            $dataGuru->nama_guru = $request->namee;
            $dataGuru->alamat = $request->addresss;
            $dataGuru->nomor_telepon = $request->nomorr;
            $dataGuru->jenis_kelamin = $request->jk;
            $dataGuru->save();

            $dataUser->username = $request->usernamee;
            $dataUser->password = bcrypt($request->passwordd);
            $dataUser->id_guru = $dataGuru->id_guru;
            $dataUser->id_roles = $request->roles;
            $dataUser->id_guru = $dataGuru->id;  
            $dataUser->save();
            return redirect('loginguru');

        }else if($request->roles == '5'){
            $dataSiswa = new Siswa;
            $dataSiswa->nama_siswa = $request->name;
            $dataSiswa->alamat = $request->address;
            $dataSiswa->jenis_kelamin = $request->jk;
            $dataSiswa->id_kelas = $request->kelas;
            $dataSiswa->save();

            $dataUser->username = $request->username;
            $dataUser->password = bcrypt($request->password);
            $dataUser->id_siswa = $dataSiswa->id_siswa;
            $dataUser->id_roles = $request->roles;  
            $dataUser->id_siswa = $dataSiswa->id;
            $dataUser->save();
            return redirect('loginsiswa');
        }
    }
    public function staffIndex()
    {
        print_r(Session::get('login'));
        if (Session::get('login')) {
            $data =  Session::get('id_staff');
            $gils = DB::table('staff')
            ->leftjoin('absensi_staff', 'absensi_staff.id_staff', '=', 'staff.id_staff')
            ->select('staff.*', 'absensi_staff.masuk', 'absensi_staff.sakit', 'absensi_staff.ijin', 'absensi_staff.alfa')
            ->where('staff.id_staff' , $data)
            ->first();
            return view('auth::admin.index', compact('gils', 'data'));
        }else{
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('loginstaff');
        }
    }
    public function guruIndex()
    {
        print_r(Session::get('login'));
        if (Session::get('login')) {
            $data = Session::get('nama_guru');
            return view('auth::guru.index',compact('data'));
        }else{
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('loginguru');
        }
    }
    public function siswaIndex()
    {
        print_r(Session::get('login'));
        if (Session::get('login')) {
            $data = Session::get('id_siswa');
            $soden = DB::table('siswa')
            ->where('siswa.id_siswa', $data)    
            ->first();
            return view('auth::siswa.index',compact('data', 'soden'));
        }else{
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('loginsiswa');
        }
    }
    public function siswaTpb()
    {
        print_r(Session::get('login'));
        if (Session::get('login')) {
            $data = Session::get('id_siswa');
            $gatel = DB::table('buku')
            ->join('klasifikasi', 'klasifikasi.id_klasifikasi', '=', 'buku.id_klasifikasi')
            ->get();
            $soden = DB::table('siswa')
            ->leftjoin('transaksi_pinjaman' , 'transaksi_pinjaman.id_siswa' , '=', 'siswa.id_siswa')
            ->select('siswa.*', 'transaksi_pinjaman.denda')
            ->where('siswa.id_siswa', $data)    
            ->first();
            return view('auth::siswa.tpb',compact('data', 'gatel', 'soden'));
        }else{
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('loginsiswa');
        }
    }
    public function siswaRiwayatTpb()
    {
        print_r(Session::get('login'));
        if (Session::get('login')) {
            $data = Session::get('id_siswa');
            $gatel = DB::table('buku')
            ->join('klasifikasi', 'klasifikasi.id_klasifikasi', '=', 'buku.id_klasifikasi')
            ->get();
            $soden = DB::table('siswa')
            ->where('siswa.id_siswa', $data)    
            ->first();
            $riwayat = DB::table('transaksi_pinjaman')
            ->join('buku', 'buku.id_buku', '=', 'transaksi_pinjaman.id_buku')
            ->join('siswa', 'siswa.id_siswa' , '=', 'transaksi_pinjaman.id_siswa')
            ->where('transaksi_pinjaman.id_siswa', $data)
            ->get();
            return view('auth::siswa.riwayattpb',compact('data', 'gatel', 'soden', 'riwayat'));
        }else{
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('loginsiswa');
        }
    }
    public function logoutstaff()
    {
        Session::flush();
        Redirect::back();
        return redirect('loginstaff')->with('alert','Kamu sudah Logout!');
    }
    public function logoutguru()
    {
        Session::flush();
        Redirect::back();
        return redirect('loginguru')->with('alert','Kamu sudah Logout!');
    }
    public function logoutsiswa()
    {
        Session::flush();
        Redirect::back();
        return redirect('loginsiswa')->with('alert','Kamu sudah Logout!');
    }
    public function siswaPinjam(Request $request, $id){
        print_r(Session::get('login'));
        if (Session::get('login')) {
            $data = Session::get('id_siswa');
            $buku = Buku::find($id);
            $buku->jumlah = $buku->jumlah - 1;
            $buku->save();
            $pinjam = DB::table('transaksi_pinjaman')
            ->insert([
                'id_buku' => $id,
                'id_siswa' => $data,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
                'status' => 'P',
                'denda' => 0
            ]);
            Alert::success('Sukses','Warning')->autoclose(2000);            
            return redirect('siswa/tpb');
        }else{
            Alert::error('You must login first!','Warning')->autoclose(2000);
            return redirect('loginsiswa');
        }
        
    }
}
