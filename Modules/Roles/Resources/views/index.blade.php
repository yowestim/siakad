@extends('apps.layout')

@section('content')
<div class="box box-primary">
    <div class="box-header text-center">
        CRUD Data Roles
    </div>
    <div class="box-body">
        <div class="card mt-5">
            <div class="card-body">
                <button type="button" class="btn btn-primary" onclick="openNewModal()">
                    Tambah Roles Baru
                </button>
                <br />
                <br />
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Nama</th>
                            <th class="th-sm" width="20%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $s)
                        <tr>
                            <td>{{ $s->nama_roles }}</td>
                            <td>
                                <a href="{{url('roles/delete').'/'.$s->id_roles}}" class="btn btn-danger">Delete</a>
                                <button type="button" class="btn btn-success"
                                    onclick="openEditModal({{$s->id_roles}}, '{{$s->nama_roles}}')">
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
<div class="modal fade" id="modal-roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{url('/roles/save') }}" enctype="multipart/form-data" id="form-roles"
                    name="form-roles">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Nama Roles</label>
                        <input type="text" id="nama_roles" name="nama_roles" class="form-control"
                            placeholder="Nama Roles.." value="">
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
function openEditModal(id, nama_roles){
    $(".modal-body #nama_roles").val(nama_roles);
    $('#modal-roles').modal('show');
    $('#form-roles').attr('action', "{{url('/roles/update').'/'}}" + id);
        // alert(nama_roles);
}
function openNewModal(){
    $(".modal-body #nama_roles").val('');
    $('#modal-roles').modal('show');
    $('#form-roles').attr('action', "{{url('/roles/save').'/'}}");
        // alert(nama_roles);
}
</script>
@endsection
