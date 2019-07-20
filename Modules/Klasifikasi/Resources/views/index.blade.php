@extends('apps.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header text-center">
        CRUD Data klasifikasi
    </div>
    <div class="box-body">
        <div class="card mt-5">
            <div class="card-body">
                <button type="button" class="btn btn-primary" onclick="openNewModal()">
                    Tambah Data Klasifikasi
                </button>
                <br />
                <br />
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Nama Klasifikasi</th>
                            <th class="th-sm" width="20%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($klasifikasi as $s)
                        <tr>
                            <td>{{ $s->nama_klasifikasi }}</td>
                            <td>
                                <a href="{{url('klasifikasi/delete').'/'.$s->id_klasifikasi}}" class="btn btn-danger">Delete</a>
                                <button type="button" class="btn btn-success"
                                    onclick="openEditModal({{$s->id_klasifikasi}}, '{{$s->nama_klasifikasi}}')">
                                    Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-klasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">klasifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{url('/klasifikasi/save') }}" enctype="multipart/form-data" id="form-klasifikasi"
                    name="form-klasifikasi">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Nama klasifikasi</label>
                        <input type="text" id="nama_klasifikasi" name="nama_klasifikasi" class="form-control"
                            placeholder="Nama klasifikasi.." value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script src="{{URL::asset('js/dataTables.min.js')}}"></script>
<script href="{{URL::asset('js/datatables-select.min.js')}}" rel="stylesheet"></script>
<script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');


});
function openEditModal(id, nama_klasifikasi){
    $(".modal-body #nama_klasifikasi").val(nama_klasifikasi);
    $('#modal-klasifikasi').modal('show');
    $('#form-klasifikasi').attr('action', "{{url('/klasifikasi/update').'/'}}" + id);
        // alert(nama_klasifikasi);
}
function openNewModal(){
    $(".modal-body #nama_klasifikasi").val('');
    $('#modal-klasifikasi').modal('show');
    $('#form-klasifikasi').attr('action', "{{url('/klasifikasi/save').'/'}}");
        // alert(nama_klasifikasi);
}
</script>
@endsection
