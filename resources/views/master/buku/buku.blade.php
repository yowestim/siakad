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
                    CRUD Data Buku
                </div>
                <div class="card-body">
                    <a href="{{URL('buku/add')}}" class="btn btn-success">Input Buku Baru</a>
                    <br/>
                    <br/>
                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-md">Judul Buku</th>
                                <th class="th-md">Isbn</th>
                                <th class="th-md">Pengarang</th>
                                <th class="th-md">Penerbit</th>
                                <th class="th-md">Tanggal Terbit</th>
                                <th class="th-sm">Klasifikasi</th>
                                <th class="th-sm">Jumlah</th>
                                <th class="th-sm">Action</th>
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
                                    <a href="" class="btn btn-warning col-xs-2">Edit</a>
                                    <a href="" class="btn btn-danger col-xs-2">Hapus</a>
                                </td>
                            </tr>
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
