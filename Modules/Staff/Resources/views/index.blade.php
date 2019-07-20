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
