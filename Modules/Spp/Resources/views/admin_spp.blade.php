@extends('apps.layout')

@section('content')
    {{----------------------------------------------------------------------------------------}}

    <div class="box box-header">
            <div class="box-body">
        {{-- <div class="box box-success box-solid">
            <div class="box-header with-border">
                <div class="box-body"> --}}
                        <div class="box-header">
                                <a style="float:right;margin-left:1%;" href="{{url('spp/cetak_pdf')}}"  class="btn btn-info" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  CETAK PDF</a>
                                <a style="float:right;" href="{{url('spp/cetak_excel')}}"  class="btn btn-success" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i>  CETAK EXCEl</a>
                            </div>
                    <table table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="th-sm">NIS</th>
                                <th class="th-sm">Nama</th>
                                <th class="th-sm">Alamat</th>
                                <th class="th-sm">Kelamin</th>
                                <th class="th-sm">Bukti Foto</th>
                                <th class="th-sm">Di Buat Pada</th>
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
                                <td>{{ $s->created_at }}</td>
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

<section class="content">
        <div class="row">
            <form action="{{url('adminspp')}}">
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
