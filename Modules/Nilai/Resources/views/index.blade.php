@extends('apps.layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">CRUD NILAI</h3>
    </div>
    <div class="box-body">
        <a href="{{URL('nilai/add')}}" class="btn btn-success">Input Nilai Baru</a>
        <br>
        <br>
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="th-md">ID</th>
                    <th class="th-md">SISWA</th>
                    <th class="th-md">UTS</th>
                    <th class="th-md">UAS</th>
                    <th class="th-md">HARIAN</th>
                    <th class="th-md">HASIL AKHIR</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($dataNilai as $data)
                    <tr>
                        <td>{{$data->id_nilai}}</td>
                        <td>{{$data->nama_siswa}}</td>
                        <td>{{$data->uts}}</td>
                        <td>{{$data->uas}}</td>
                        <td>{{$data->harian}}</td>
                        <td>{{$data->hasil_akhir}}</td>
                        <td>
                            <a href="{{URL('nilai/update', $data->id_nilai)}}" class="btn btn-warning">Edit</a>
                            <a href="{{URL('nilai/delete', $data->id_nilai)}}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
<script src="{{URL::asset('js/jquery.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/dataTables.min.js')}}"></script>
<script href="{{URL::asset('js/datatables-select.min.js')}}" rel="stylesheet"></script>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
</script>
@endsection
