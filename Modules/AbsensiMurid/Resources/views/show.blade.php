@extends('apps.layout')

@section('content')
    <h1>Absensi Murid</h1>
<div class="box box-header">
    <div class="box-body">
            <div class="box-header">

                <a href="{{url('/absensiswa')}}" class="btn btn-primary">Input Absensi Murid</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                        <th class="th-sm">No</th>
                        <th class="th-sm">Nama Murid</th>
                        <th class="th-sm">Alamat</th>
                        <th class="th-sm">Kelas</th>
                        <th class="th-sm">Masuk</th>
                        <th class="th-sm">Sakit</th>
                        <th class="th-sm">Ijin</th>
                        <th class="th-sm">Alfa</th>
                        <th class="th-sm">Dalam ( Hari )</th>
                        <th class="th-sm">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <input type="hidden" value="{{$i = 1}}">
                    @foreach ($absensimurid as $item)
                    <tr>
                    <input type="hidden" value="{{$item->id_siswa}}">
                    <td>{{$i++}}</td>
                    @if ($item->jenis_kelamin == "P")
                        <td>{{$item->nama_siswa}} ( Perempuan )</td>
                    @else
                    <td>{{$item->nama_siswa}} ( Laki-Laki )</td>
                    @endif
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->nama_kelas}}</td>
                    <td>{{ round(( $item->masuk / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                    <td>{{ round(( $item->sakit / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                    <td>{{ round(( $item->ijin / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                    <td>{{ round(( $item->alfa / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                    <td>{{$item->masuk + $item->sakit + $item->ijin + $item->alfa}} Hari</td>
                    <td><a type="button" href="/absensiswa/destroy/{{$item->id_absensi_siswa}}" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
    </div>
</div>
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
