@extends('apps.layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">CRUD Data Buku</h3>
    </div>
    <div class="box-body">
        <a href="{{URL('buku/add')}}" class="btn btn-success">Input Buku Baru</a>
        <br>
        <br>
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="th-md">Judul Buku</th>
                    <th class="th-md">Isbn</th>
                    <th class="th-md">Pengarang</th>
                    <th class="th-md">Penerbit</th>
                    <th class="th-md">Tanggal Terbit</th>
                    <th class="th-sm">Klasifikasi</th>
                    <th class="th-sm">Jumlah</th>
                    <th class="col-sm-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="" class="btn btn-warning">Edit</a>
                        <a href="" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
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
