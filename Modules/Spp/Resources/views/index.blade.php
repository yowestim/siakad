@extends('apps.layout')

@section('content')
<style type="text/css">
    .search-form .form-group {
        float: left !important;
        transition: all 0.35s, border-radius 0s;
        width: 32px;
        height: 32px;
        background-color: #fff;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
        border-radius: 25px;
        border: 1px solid #ccc;
    }

    .search-form .from-group:focus {
        width: 100%;
        border-radius: 4px 25px 25px 4px;
    }

    .search-form .form-group input.form-control {
        padding-right: 20px;
        border: 0 none;
        background: transparent;
        box-shadow: none;
        display: block;
    }

    .search-form .form-group input.form-control::-webkit-input-placeholder {
        display: none;
    }

    .search-form .form-group input.form-control:-moz-placeholder {

        display: none;
    }

    .search-form .form-group input.form-control::-moz-placeholder {

        display: none;
    }

    .search-form .form-group input.form-control:-ms-input-placeholder {
        display: none;
    }

    .search-form .form-group:hover,
    .search-form .form-group.hover {
        width: 100%;
        border-radius: 4px 25px 25px 4px;
    }

    .search-form .form-group span.form-control-feedback {
        position: absolute;
        top: -1px;
        right: -2px;
        z-index: 2;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        color: #3596e0;
        left: initial;
        font-size: 14px;
    }
</style>
<!------------------------------------------------------------------------------------------------->

<!-- ------------------------------------------------------------------------------------------- -->
<div class="row">
    <div class="col-md-4" style="margin-right:0px;">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h4 class="box-tittle">Informasi Siswa</h4>
            </div>
            <div class="box-body">
                {{-- @isset($_GET['cari']) --}}
                {{-- @if (count($spp) > 0) --}}
                <table class="table table-dark" style="width:230px;">
                    <tr width="300px">
                        <th>NIS</th>
                        <th>{{ $spp->id_siswa }}</th>
                    </tr>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>{{ $spp->nama_siswa }}</th>
                    </tr>
                    <tr>
                        <th>Kelamin</th>
                        <th>@if ($spp->jenis_kelamin == "l")
                            {{"laki-laki" }}
                            @else
                            {{"perempuan" }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>{{ $spp->alamat }}</th>
                    </tr>
                </table>
                {{-- @endif --}}
                {{-- @endisset --}}

            </div>
        </div>
    </div>
    <!-- ---------------------------TAGIHAN BULANAN----------------------------------- -->
    <div class="col-md-8">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h4 class="box-tittle">Tagihan Bulanan</h4>
            </div>
            <div class="row">
                @foreach ($spp2 as $item)
                <div class="col-md-4">
                    <div class="box box-widget widget-user-2">
                        @if ($item->id_spp == 0)
                        <div class="fixed-top pull-right"
                            onclick="openNewModal('{{$item->bulan}}', {{$item->id_spp}}, '{{$item->status}}')">
                            <ul class="btn">
                                <i class="fa fa-fw fa-upload"></i>
                            </ul>
                        </div>
                        @endif
                        <div class="widget-user-header bg-yellow">

                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">SPP {{$item->bulan}}<span
                                            class="pull-right">{{$item->jumlah_bayar}}</span></a></li>
                                <li>
                                    <a href="#"> Status
                                        <span>
                                            @if ($item->status == "B")
                                            <span class="pull-right badge bg-red">Belum Dibayar</span>
                                            @elseif ($item->status == "L")
                                            <span class="pull-right badge bg-green">Lunas</span>
                                            @elseif ($item->status == "M")
                                            <span class="pull-right badge bg-yellow">Menunggu Konfirmasi</span>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- -----------------------------FORM PEMBAYARAN--------------------------------- --}}

<div class="modal fade" id="modal-spp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title center" id="exampleModalLabel">PEMBAYARAN SPP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{url('/spp/save') }}" enctype="multipart/form-data" id="form-spp"
                    name="form-spp">

                    {{ csrf_field() }}
                    <input type="hidden" name="idspp" id="idspp">
                    <div class="form-group">
                        <input type="hidden" id="bulan" name="bulan">
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="jumlah_bayar" class="form-control" value="500000">
                    </div>

                    <div class="form-group">
                        <input name="status" value="M" type="hidden">
                    </div>
                    <p>
                        <h5>CARA PEMBAYARAN :</h5>
                        <h6>1. Pastikan sudah tranfer Rp.500.000 ke rekening sekolah (BRI:88808271)</h6>
                        <h6>2. Screenshot/foto bukti tranfer yang sudah anda lakukan</h6>
                        <h6>3. Upload bukti TRANSAKSI <i><b>hanya bisa dilakukan satu kali</b></i></h6>
                        <h6>4. Upload bukti tersebut di bawah ini</h6>

                    </p>

                    <div class="form-group">
                        <label>BUKTI </label>
                        <input type="file" name="bukti_transaksi" class="form-control" onchange="sendImages(this)">

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="" id="viewImages" style="max-height: 100%; max-width: 100%;">
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
        $('#label_bulan').html('<label>'+$bulan+'</label>');
        $('#modal-spp').modal('show');
        $('#form-spp').attr('action', "{{url('/spp/save').'/'}}");
    }

    function sendImages(input) {
         if (input.files && input.files[0]) {
           var imgPath = $(input)[0].value;
           var extn = imgPath.substring(imgPath.lastIndexOf('.')+  1).toLowerCase();

           if(extn == 'jpg' || extn == 'jpeg' || extn == 'png'){
             var size = $(input)[0].size;
               var maxsize = 1024*1024; //1MB

               if (size < maxsize) {

                 var reader = new FileReader();

                 reader.onload = function (e) {
                   $("#viewImages").attr('src', e.target.result);
                 };

                 reader.readAsDataURL(input.files[0]);
               }
               else{
                 alert("Image Over 1MB");
               }
             }
             else{
               alert("Image Only !!");
               $("image").val("");
             }
           }
         }

</script>
@endsection
