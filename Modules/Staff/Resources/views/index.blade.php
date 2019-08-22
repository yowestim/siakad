@extends('apps.layout')

@section('content')
    <h1>CRUD Data Staff</h1>

    <p>
        This view is loaded from module: {!! config('staff.name') !!}
    </p>
<div class="box box-header">
    <div class="box-body">
            <div class="box-header">

                <a href="{{url('staff/tambah')}}" class="btn btn-primary">Input New Staff</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                        <th class="th-sm">Nama</th>
                        <th class="th-sm">Alamat</th>
                        <th class="th-sm">No. telp</th>
                        <th class="th-sm">Jenis Kelamin</th>
                        <th class="th-sm">foto</th>
                        <th class="th-sm">OPSI</th>
                </tr>
                </thead>
                <tbody>
                        @foreach($staff as $s)
                        <tr>
                            <td>{{ $s->nama_staff }}</td>
                            <td>{{ $s->alamat }}</td>
                            <td>{{ $s->nomor_telepon }}</td>
                            <td>
                                @if ($s->jenis_kelamin == 'L')
                                    Laki - Laki
                                @elseif ($s->jenis_kelamin == 'P')
                                    Perempuan
                                @else
                                    null
                                @endif
                            </td>
                            <td align="center"><img height="100" width="150" src="{{URL::asset('./images/staff/'.$s->foto)}}" alt=""></td>
                            <td>
                                <a href="{{url('staff/edit').'/'.$s->id_staff}}" class="btn btn-warning">Edit</a>
                                <a href="{{url('staff/delete').'/'.$s->id_staff}}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="margin-right:0px;">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h4 class="box-tittle">Informasi staff</h4>
                <a href="{{url('absen/cetak_pdf')}}" class="btn btn-upload">PDF</a>
                <a href="{{url('absen/cetak_excel')}}" class="btn btn-info">Excel</a>
            </div>
            <div class="box-body">
                {{-- @isset($_GET['cari']) --}}
                {{-- @if (count($absen) > 0) --}}
                <table class="table table-dark" style="width:230px;">
                    <tr width="300px">
                        <th>NIS</th>
                        <th>{{ $absen1->id_staff }}</th>
                    </tr>
                    <tr>
                        <th>Nama staff</th>
                        <th>{{ $absen1->nama_staff }}</th>
                    </tr>
                    <tr>
                        <th>Kelamin</th>
                        <th>@if ($absen1->jenis_kelamin == "l")
                            {{"laki-laki" }}
                            @else
                            {{"perempuan" }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>{{ $absen1->alamat }}</th>
                    </tr>
                </table>
                {{-- @endif --}}
                {{-- @endisset --}}

            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <form action="{{url('absensi')}}">
            <div class="col-md-5">
                <div class="form-group">
                        <label for="exampleInputFile">Pilih Tanggal awal</label>
                              <input value="{{$tgl_awal}}" class="form-control" type="date" name="tgl_awal" id="tgl_awal">
                      </div>
            </div>
            <div class="col-md-5">
                    <div class="form-group">
                            <label for="exampleInputFile">Pilih Tanggal Akhir</label>
                                  <input value="{{$tgl_akhir}}" class="form-control" type="date" name="tgl_akhir" id="tgl_akhir">
                          </div>
                </div>
            <div class="col-md-2">
                    <div class="form-group">
                            <label for="exampleInputFile">Cari</label>
                    <input class="form-control btn btn-primary" type="submit" value="cari">
                    </div>
                </div>

            </form>
    <div class="col-md-12">

            <!-- BAR CHART -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Bar Chart</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

      </section>
@stop
@section('script')
        {{-- <script src="{{URL::asset('js/dataTables.min.js')}}"></script> --}}
        <script>
            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });

            $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })
            </script>
@endsection
