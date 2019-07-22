@extends('apps.layout')

@section('content')
    <h1>Input Absensi Murid</h1>
    <div class="box box-header">
        <div class="box-body">
                <div class="box-header">
    
                    <a type="button" href="/absensiswa/show" class="btn btn-primary">Lihat Absensi</a>
                </div>
    <form action="/absensiswa/store/" method="POST">
        {{ csrf_field() }}
        <div class="box-body">
        <table id="example" class="table table-stripped table-bordered">
            <thead>
                <tr>
                    <th class="th-sm">No</th>
                    <th class="th-sm">Nama Murid</th>
                    <th class="th-sm">Alamat</th>
                    <th class="th-sm">Kelas</th>
                    <th class="th-sm">Hari Ke</th>
                    <th class="th-sm">Absensi</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" value="{{$i = 1}}">
                @foreach ($siswa as $item)
                <tr>
                <input type="hidden" name="id_siswa[]" value="{{$item->id_siswa}}">
                <td>{{$i++}}</td>
                @if ($item->jenis_kelamin == "P")
                    <td>{{$item->nama_siswa}} ( Perempuan )</td>
                @else
                <td>{{$item->nama_siswa}} ( Laki-Laki )</td>
                @endif
                <td>{{$item->alamat}}</td>
                <td>{{$item->nama_kelas}}</td>
                <td>{{($item->masuk + $item->sakit + $item->ijin + $item->alfa) + 1}}</td>
                <td>
                    <select class="form-control" name="select_absen[]">
                        <option name="masuk" value="masuk">Masuk</option>
                        <option name="sakit" value="sakit">Sakit</option>
                        <option name="ijin" value="ijin">Ijin</option>
                        <option name="alfa" value="alfa">Alfa</option>
                    </select>
                </td>
            
            </tr>
            @endforeach
        </tfoot>
    </table>
    </div>
    <button type="submit" class="btn btn-success" style="float:right">
        <span class="glyphicon glyphicon-send"> Input</span>
    </button>
    </form>
@stop