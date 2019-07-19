<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/datatables-select.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/datatables.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/mdb.lite.min.css')}}">

        <title>CRUD Staff Laravel</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Staff
                </div>
                <div class="card-body">
                    <a href="{{url('spp/tambah')}}" class="btn btn-primary">Input Staff Baru</a>
                    <br/>
                    <br/>
                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Id Spp</th>
                                <th class="th-sm">Bulan</th>
                                <th class="th-sm">Jumlah Bayar</th>
                                <th class="th-sm">Status</th>
                                <th class="th-sm">Id Siswa</th>
                                <th class="th-sm">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spp as $s)
                            <tr>
                                <td>{{ $s->id_spp }}</td>
                                <td>{{ $s->bulan }}</td>
                                <td>{{ $s->jumlah_bayar }}</td>
                                <td>{{ $s->status }}</td>
                                <td>{{ $s->nama_siswa}}</td>
                                <td>
                                    <a href="{{url('spp/edit').'/'.$s->id_spp}}" class="btn btn-warning">Edit</a>
                                    <a href="{{url('spp/delete').'/'.$s->id_spp}}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
<div class="panel-body">
                    {!! $chart->html() !!}
                </div>
                {!! Charts::scripts() !!}
        {!! $chart->script() !!}
    </body>
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/dataTables.min.js')}}"></script>
    <script href="{{URL::asset('js/datatables-select.min.js')}}" rel="stylesheet"></script>
</html>

<script>
$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>
