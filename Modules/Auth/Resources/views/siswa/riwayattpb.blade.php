@extends('apps.layout')
@section('content')
<h3>Riwayat Peminjaman Buku {{$soden->nama_siswa}}!!</h3>
<a href="{{url('siswa/index')}}" class="btn btn-primary">Dashboard</a>
<a href="{{url('siswa/tpb')}}" class="btn btn-success">Daftar Buku Perpustakaan</a>
<div class="box box-header">
        <div class="box-body">
                <div class="box-header">
                   Daftar Riwayat Peminjaman
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                            <th class="th-sm">No.</th>
                            <th class="th-sm">Judul Buku</th>
                            <th class="th-sm">Tanggal Pinjam</th>
                            <th class="th-sm">Tanggal Kembali</th>
                            <th class="th-sm">Status</th>
                            <th class="th-sm">Denda</th>
                    </tr>
                    </thead>
                    <tbody>
                    <input value="{{$no = 1}}" hidden>
                            @foreach($riwayat as $s)
                            <tr>
                            <td>{{$no++}}</td>
                                <td>{{ $s->judul_buku }}</td>
                                <td>{{ $s->tanggal_pinjam }}</td>
                                <td>{{ $s->tanggal_dikembalikan }}</td>
                                @if ($s->status == "P")
                                    <td>Pinjam</td>
                                    {{-- <td>Rp.{{ number_format($s->denda, 0 , ',', '.') }}</td> --}}
                                    <td>
                                        @php
                                                $date1=new DateTime(date('Y-m-d', strtotime($s->tanggal_dikembalikan)));
                                                $date2=new DateTime(date('Y-m-d', strtotime(date("Y-m-d"))));
                                        @endphp
                                        @if($date1 < $date2) 
                                                @php
                                                        $diff = $date1->diff($date2)->days;   
                                                        $denda = $diff*10000; 
                                                @endphp
                                        <input name="denda" value="{{$s->denda + ($diff*10000)}}" hidden>Rp. {{number_format($denda, 0 , ',', '.')}}
                                        @else 
                                        <input name="denda" value="0" hidden>Rp.{{number_format(0, 0 , ',', '.')}}
                                        @endif
                                        </td>
                                    <td>
                                    </td>
                                    @elseif ($s->status == "K")
                                    <td>Dikembalikan</td>
                                    <td>Rp.{{ number_format($s->denda, 0, ',', '.') }}</td>
                                    @endif
                            </tr>
                            @endforeach
                    </tfoot>
                  </table>
                  <marquee scrollamount="10">
                      <h3 style="color:red">JIKA SUDAH MEMBAYAR DENDA JANGAN LUPA KONFIRMASI KE ADMIN SIAKAD AGAR TIDAK TERJADI KESALAHPAHAMAN!!!</h3>
                    </marquee>
                </div>
                </div>
            </div>
        </div>
    </div>
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

                <form method="post" action="{{url('/siswa/pinjam') }}" enctype="multipart/form-data" id="form-detail-pinjam"
                    name="form-detail-pinjam">

                    {{ csrf_field() }}
                    <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                      <th class="th-sm">Judul Buku</th>
                                      <th class="th-sm">ISBN</th>
                                      <th class="th-sm">Pengarang</th>
                                      <th class="th-sm">Penerbit</th>
                                      <th class="th-sm">Tanggal Terbit</th>
                                      <th class="th-sm">Klasifikasi</th>
                                      <th class="th-sm">Jumlah</th>
                              </tr>
                              </thead>
                              <tbody>
                                      <tr>
                                          <td><p id="judul_buku"></td>
                                          <td><p id="isbn"></td>
                                          <td><p id="pengarang"></td>
                                          <td><p id="penerbit"></td>
                                          <td><p id="tanggal_terbit"></td>
                                          <td><p id="nama_klasifikasi"></td>
                                          <td><p id="jumlah"></td>
                                      </tr>
                              </tfoot>
                            </table>
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
<script>
function openDetail(judul_buku, isbn, pengarang, penerbit, tanggal_terbit, nama_klasifikasi, jumlah){
  document.getElementById("judul_buku").innerHTML = judul_buku;
  document.getElementById("isbn").innerHTML = isbn;
  document.getElementById("pengarang").innerHTML = pengarang;
  document.getElementById("penerbit").innerHTML = penerbit;
  document.getElementById("tanggal_terbit").innerHTML = tanggal_terbit;
  document.getElementById("nama_klasifikasi").innerHTML = nama_klasifikasi;
  document.getElementById("jumlah").innerHTML = jumlah;
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