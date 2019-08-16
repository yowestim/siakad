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
    <div class="col-md-12" style="margin-right:0px;">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h4 class="box-tittle">Informasi Siswa</h4>
                <a href="{{url('spp/cetak_pdf')}}" class="btn btn-upload">PDF</a>
                <a href="{{url('spp/cetak_excel')}}" class="btn btn-info">Excel</a>
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
    <section class="content">
        <div class="row">
            <form action="{{url('absensi')}}">
            <div class="col-md-5">
                <div class="form-group">
                        <label for="exampleInputFile">Pilih Tanggal awal</label>
                              <input value="{{$tgl_awal}}" class="form-control" type="date" name="tgl_awal" id="tgl_awal">
                      </div>
            </div>
            <div class="col-md-5">
                    <div class="form-group">
                            <label for="exampleInputFile">Pilih Tanggal Akhir</label>
                                  <input value="{{$tgl_akhir}}" class="form-control" type="date" name="tgl_akhir" id="tgl_akhir">
                          </div>
                </div>
            <div class="col-md-2">
                    <div class="form-group">
                            <label for="exampleInputFile">Cari</label>
                    <input class="form-control btn btn-primary" type="submit" value="cari">
                    </div>
                </div>

            </form>
    <div class="col-md-12">

            <!-- BAR CHART -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Bar Chart</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

      </section>
    <!-- ---------------------------TAGIHAN BULANAN----------------------------------- -->
    
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
         $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    $chart = <?php echo json_encode($chart) ?>;
    // alert($chart_spp);
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : $chart
        }
      ]
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[0].fillColor   = '#00a65a'
    barChartData.datasets[0].strokeColor = '#00a65a'
    barChartData.datasets[0].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>
@endsection