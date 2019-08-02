@extends('apps.layout')

@section('content')
    <h1>CRUD Data Staff</h1>

    <p>
        This view is loaded from module: {!! config('staff.name') !!}
    </p>
<div class="box box-header">
    <div class="box-body">
            <div class="box-header">
                <a href="{{url('staff/tambah')}}" class="btn btn-primary">Input New Staff</a>
                <a style="float:right;margin-left:1%;" href="{{url('spp/cetak_pdf')}}"  class="btn btn-info" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  CETAK PDF</a>
                <a style="float:right;" href="{{url('spp/cetak_excel')}}"  class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i>  CETAK EXCEl</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
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
                            <td>
                                @if ($s->jenis_kelamin == 'L')
                                    Laki - Laki
                                @elseif ($s->jenis_kelamin == 'P')
                                    Perempuan
                                @else
                                    null
                                @endif
                            </td>
                            <td align="center"><img height="100" width="150" src="{{URL::asset('./images/staff/'.$s->foto)}}" alt=""></td>
                            <td>
                                <a href="{{url('staff/edit').'/'.$s->id_staff}}" class="btn btn-warning">Edit</a>
                                <a href="{{url('staff/delete').'/'.$s->id_staff}}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                </tfoot>
              </table>
            </div>

  </div>


        </div>
        <section class="content">
                <div class="row">
                    <form action="{{url('staff')}}">
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

            <!-- /.box-body -->
    </div>
</div>
@stop
@section('script')
        {{-- <script src="{{URL::asset('js/dataTables.min.js')}}"></script> --}}
        <script>
            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            $('#example1').DataTable()

            });

            $(function () {

            $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
            })
        })


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
