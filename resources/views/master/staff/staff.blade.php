<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/datatables-select.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/mdb.lite.min.css')}}">
        <script src="{{URL::asset('js/jquery.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('js/dataTables.min.js')}}"></script>
        <script href="{{URL::asset('js/datatables-select.min.js')}}" rel="stylesheet"></script>
        <title>Tutorial Laravel #21 : CRUD Eloquent Laravel</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Staff
                </div>
                <div class="card-body">
                    <a href="{{url('staff/tambah')}}" class="btn btn-primary">Input Staff Baru</a>
                    <br/>
                    <br/>
                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>{{ $s->foto }}</td>
                                <td>
                                    <a href="{{url('staff/edit').'/'.$s->id_staff}}" class="btn btn-warning">Edit</a>
                                    <a href="{{url('staff/delete').'/'.$s->id_staff}}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>
