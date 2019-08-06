@extends('apps.layout')

@section('content')
    <h1>Transaksi Peminjaman Buku</h1>
    <div class="box box-header">
            <div class="box-body">
                    <div class="box-header">
                       Daftar Buku Perpustakaan 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                                <th class="th-sm">No.</th>
                                <th class="th-sm">Nama Siswa</th>
                                <th class="th-sm">Judul Buku</th>
                                <th class="th-sm">Tanggal Pinjam</th>
                                <th class="th-sm">Tanggal Kembali</th>
                                <th class="th-sm">Status</th>
                                <th class="th-sm">Denda</th>
                                <th class="th-sm">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <input value="{{$no = 1}}" hidden>
                                @foreach($gatel as $s)
                                <tr>
                                <td>{{$no++}}</td>
                                <input name="idbuku" value="{{$s->id_buku}}" hidden>
                                <td>{{$s->nama_siswa}}</td>
                                    <td>{{ $s->judul_buku }}</td>
                                    <td>{{ $s->tanggal_pinjam }}</td>
                                    <td>{{ $s->tanggal_dikembalikan }}</td>
                                    @if ($s->status == "P")
                                    <td>Pinjam</td>
                                    {{-- <td>Rp.{{ number_format($s->denda, 0 , ',', '.') }}</td> --}}
                                    <td>
                                        @php
                                                $date1=new DateTime(date('Y-m-d', strtotime($s->tanggal_dikembalikan)));
                                                $date2=new DateTime(date('Y-m-d', strtotime(date("Y-m-d"))));
                                        @endphp
                                        @if($date1 < $date2) 
                                                @php
                                                        $diff = $date1->diff($date2)->days;   
                                                        $denda = $diff*10000; 
                                                @endphp
                                        <input name="denda" value="{{$s->denda + ($diff*10000)}}" hidden>Rp. {{number_format($denda, 0 , ',', '.')}}
                                        @else 
                                        <input name="denda" value="0" hidden>Rp.{{number_format(0, 0 , ',', '.')}}
                                        @endif
                                        </td>
                                    <td>
                                    <a href="{{url('tpb/kembali').'/'.$s->id_transaksi_pinjaman}}?idbuku={{$s->id_buku}}" class="btn btn-warning">Sudah Dikembalikan</a>
                                    </td>
                                    @elseif ($s->status == "K")
                                    <td>Dikembalikan</td>
                                    <td>Rp.{{ number_format($s->denda, 0, ',', '.') }}</td>
                                   
                                    @if ($s->denda == 0)
                                    <td>
                                        <a href="{{url('tpb/delete').'/'.$s->id_transaksi_pinjaman}}" class="btn btn-danger">Delete</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="{{url('tpb/bayarDenda').'/'.$s->id_transaksi_pinjaman}}" class="btn btn-danger">Sudah Bayar Denda</a>
                                    </td>
                                    @endif
                                    
                                    @endif
                                </tr>
                                @endforeach
                        </tfoot>
                      </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
@stop
 