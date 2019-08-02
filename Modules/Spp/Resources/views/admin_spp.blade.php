@extends('apps.layout')

@section('content')
<div class="row">
    {{-- <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <center><h4 class="box-tittle">PEMBAYARAN SPP</h4></center>
            </div> --}}
            <div class="box-body pull-right" style="margin:20px;">
                {{-- <form action="/spp/cari/{{ old('cari')}}" method="GET">
                    <input type="text" name="cari" placeholder="Cari Siswa .." value="{{ old('cari') }}">
                    <input type="submit" value="CARI">
                </form> --}}
                {{-- <form action="/spp/cari" class="search-form" method="GET" style="width:300px;">
                    <div class="form-group has-feedback">
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" class="form-control" name="cari" id="search" placeholder="NIS : (801001)">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form> --}}
                <form class="form-inline my-2 my-lg-0" method="get" action="{{url('adminspp/search')}}">
                    <input class="form-control mr-sm-2" type="text" name="q" placeholder="NIS : (808001)" aria-label="Search">
                     <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
                 </form>
             </div>
        {{-- </div>
    </div>  --}}
    {{----------------------------------------------------------------------------------------}}

    <div class="col-md-12">
        {{-- <div class="box box-success box-solid">
            <div class="box-header with-border">
                <div class="box-body"> --}}
                    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">NIS</th>
                                <th class="th-sm">Nama</th>
                                <th class="th-sm">Alamat</th>
                                <th class="th-sm">Kelamin</th>
                                <th class="th-sm">Bukti Foto</th>
                                <th class="th-sm">Status SPP</th>
                                <th class="th-sm">UPDATE STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminspp as $s)
                            <tr>
                                <td>{{ $s->id_siswa }}</td>
                                <td>{{ $s->nama_siswa }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td>@if ($s->jenis_kelamin = "l")
                                        {{"laki-laki"}}
                                    @else
                                        {{"perempuan"}}
                                    @endif
                                </td>
                                <td>{{ $s->bukti_transaksi }}</td>
                                <td><span>
                                        @if ($s->status == "M")
                                        <span class="badge bg-yellow">{{"Menunggu Konfirmasi" }}</span>
                                        @elseif ($s->status == "B")
                                        <span class="badge bg-red">{{"Belum Bayar" }}</span>
                                        @else
                                        <span class="badge bg-green">{{"LUNAS" }}</span>
                                        @endif</td>
                                    </span>
                                <td>
                                    <div class=""
                                        onclick="openNewModal('{{$s->bulan}}', {{$s->id_spp}}, '{{$s->status}}')">
                                        <ul class="btn">
                                            <i class="badge bg-black">UPDATE</i>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{-- </div>
            </div>
        </div> --}}
    </div>

</div>
{{-- ------------------------------------------------------------------------------------ --}}
<div class="modal fade" id="modal-spp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="label_bulan"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-spp">

                <form method="post" action="{{url('/adminspp/save')}}" enctype="multipart/form-data" id="form-spp"
                    name="form-spp">

                    {{ csrf_field() }}
                    <input type="hidden" name="id_spp" id="id_spp"><br>
                    <div class="form-group">
                        <label style="padding:15px;">Status :</label>
                        <select name="status">
                            <option value="M">Menunggu Konfirmasi</option>
                            <option value="B">Belum Bayar</option>
                            <option value="L">LUNAS</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input value="{{$s->bukti_transaksi}}" type="hidden" name="foto_old" id="foto_old">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="{{asset('images/spp').'/'.$s->bukti_transaksi}}" id="viewImages" style="max-height: 100%; max-width: 100%;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-success">Save</button>
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
    function openNewModal($bulan, $idspp, $status){
        $('.modal-body #bulan').val($bulan);
        $('.modal-body #idspp').val($idspp);
        $('.modal-body #status').val($status);
        $('#id_spp').val($idspp);
        $('#label_bulan').html('<label>Bukti Pembayaran SPP Bulan '+$bulan+'</label>');
        $('#modal-spp').modal('show');
        $('#form-spp').attr('action', "{{url('/adminspp/save').'/'}}");
    }

</script>
@endsection
