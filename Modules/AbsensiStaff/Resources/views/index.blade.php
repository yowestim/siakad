@extends('apps.layout')

@section('content')
    <h1>Input Absensi</h1>
    <a type="button" href="/absenstaff/show" class="btn btn-primary">Lihat Absensi</a>
    
    <form action="/absenstaff/store/" method="POST">
        {{ csrf_field() }}
        <table id="example" class="table table-stripped table-bordered">
            <thead>
                <tr class="table100-head">
                    <th class="column1">No</th>
                    <th class="column2">Nama Staff</th>
                    <th class="column3">Alamat</th>
                    <th class="column4">No. HP</th>
                    <th class="column5">Absensi</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" value="{{$i = 1}}">
                @foreach ($staff as $item)
                <tr>
                <input type="hidden" name="id_staff[]" value="{{$item->id_staff}}">
                <td>{{$i++}}</td>
                @if ($item->jenis_kelamin == "P"){
                    <td>{{$item->nama_staff}} ( Perempuan )</td>
                }
                @else
                <td>{{$item->nama_staff}} ( Laki-Laki )</td>
                @endif
                <td>{{$item->alamat}}</td>
                <td>{{$item->nomor_telepon}}</td>
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
