@extends('apps.layout')

@section('content')
    <h1>Input Absensi Murid</h1>
    <a type="button" href="/absensiswa/show" class="btn btn-primary">Lihat Absensi</a>
    
    <form action="/absensiswa/store/" method="POST">
        {{ csrf_field() }}
        <table id="example" class="table table-stripped table-bordered">
            <thead>
                <tr class="table100-head">
                    <th class="column1">No</th>
                    <th class="column2">Nama Murid</th>
                    <th class="column3">Alamat</th>
                    <th class="column4">Kelas</th>
                    <th class="column5">Hari Ke</th>
                    <th class="column6">Absensi</th>
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
        </tbody>
    </table>
    <button type="submit" class="btn btn-success" style="float:right">
        <span class="glyphicon glyphicon-send"> Input</span>
    </button>
    </form>
@stop
