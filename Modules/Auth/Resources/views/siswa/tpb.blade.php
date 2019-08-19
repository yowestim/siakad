@extends('apps.layout')
@section('content')
@include('sweet::alert')
<h3>Selamat Datang {{$soden->nama_siswa}}!! Anda Telah Masuk Halaman Peminjaman Buku</h3>
<a href="{{url('siswa/index')}}" class="btn btn-primary">Dashboard</a>
<a href="{{url('siswa/riwayattpb')}}" class="btn btn-success">Daftar Riwayat Peminjaman</a>
@if ($soden->id_transaksi_pinjaman != null)
<h3 style="color:red">SETIAP SISWA HANYA BOLEH MEMINJAM MAKSIMAL 1 BUKU</h3>      
@else
    
@if ($soden->denda == 0)
<div class="box box-header">
    <div class="box-body">
            <div class="box-header">
               Daftar Buku Perpustakaan 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                        <th class="th-sm">No.</th>
                        <th class="th-sm">Judul Buku</th>
                        <th class="th-sm">Jumlah</th>
                        <th class="th-sm">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <input value="{{$no = 1}}" hidden>
                        @foreach($gatel as $s)
                        <tr>
                        <td>{{$no++}}</td>
                            <td>{{ $s->judul_buku }}</td>
                            <td>{{$s->jumlah}}</td>
                            @if ($s->jumlah != 0)
                            <td>
                                <button type="button" class="btn btn-success" onclick="openDetail(
                                  {{$s->id_buku}},
                                   '{{ $s->judul_buku }}'
                            ,{{ $s->isbn }}
                            ,'{{ $s->pengarang }}'
                            ,'{{$s->penerbit}}'
                            ,'{{$s->tanggal_terbit}}'
                            ,'{{$s->nama_klasifikasi}}'
                                )">Detail</button>
                            </td>
                            @else
                              <td>Buku Masih Kosong</td>
                            @endif
                        </tr>
                        @endforeach
                </tfoot>
              </table>
            </div>
          </div>
      </div>
    </div>
</div>
<marquee scrollamount="10">
  <h3 style="color:red">JIKA TELAT MENGEMBALIKAN AKAN DIBERIKAN DENDA 10.000 / HARI BERLAKU KELIPATAN!!!</h3>
</marquee>
@else
  <h3 style="color:red">TOLONG BAYAR DENDA DAHULU SEBELUM PINJAM BUKU</h3>    
@endif

@endif

    <div class="modal fade" id="modal-tpb-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Detail Buku</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" enctype="multipart/form-data" id="form-detail-pinjam"
                    name="form-detail-pinjam">

                    {{ csrf_field() }}
                    <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                      <th class="th-sm">Id Buku</th>
                                      <th class="th-sm">Judul Buku</th>
                                      <th class="th-sm">ISBN</th>
                                      <th class="th-sm">Pengarang</th>
                                      <th class="th-sm">Penerbit</th>
                                      <th class="th-sm">Tanggal Terbit</th>
                                      <th class="th-sm">Klasifikasi</th>
                              </tr>
                              </thead>
                              <tbody>
                                      <tr>
                                          <td><p id="id_buku"></td>
                                          <td><p id="judul_buku"></td>
                                          <td><p id="isbn"></td>
                                          <td><p id="pengarang"></td>
                                          <td><p id="penerbit"></td>
                                          <td><p id="tanggal_terbit"></td>
                                          <td><p id="nama_klasifikasi"></td>
                                      </tr>
                              </tbody>
                            </table>
                            <span style="float:left; margin-left:15%">Tanggal Dipinjam <input class="form-control" type="date" name="tanggal_pinjam" required></span>
                            <span style="float:right; margin-right:15%">Tanggal Dikembalikan <input class="form-control" type="date" name="tanggal_dikembalikan" required></span>
                          </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function openDetail(id_buku, judul_buku, isbn, pengarang, penerbit, tanggal_terbit, nama_klasifikasi){
  document.getElementById("id_buku").innerHTML = id_buku;
  document.getElementById("judul_buku").innerHTML = judul_buku;
  document.getElementById("isbn").innerHTML = isbn;
  document.getElementById("pengarang").innerHTML = pengarang;
  document.getElementById("penerbit").innerHTML = penerbit;
  document.getElementById("tanggal_terbit").innerHTML = tanggal_terbit;
  document.getElementById("nama_klasifikasi").innerHTML = nama_klasifikasi;
    $('#modal-tpb-detail').modal('show');
    $('#form-detail-pinjam').attr('action', "{{url('/siswa/pinjam').'/'}}" + id_buku);
}
</script>
@endsection
@section('logout')
<li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{$data}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

            <p>
              {{$data}}
              <small>Member since Nov. 2012</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{url('/logoutsiswa')}}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
@endsection
@section('name')
    {{$data}}
@endsection