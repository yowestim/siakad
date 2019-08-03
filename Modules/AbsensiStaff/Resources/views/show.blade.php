@extends('apps.layout')

@section('content')
    <h1>Daftar Absensi</h1>
    <a type="button" href="/absenstaff" class="btn btn-primary">Input Absensi</a>
       <table id="example" class="table table-stripped table-bordered">
            <thead>
                <tr class="table100-head">
                    <th class="column1">No</th>
                    <th class="column2">Nama Staff</th>
                    <th class="column3">Alamat</th>
                    <th class="column4">No. HP</th>
                    <th class="column5">Masuk</th>
                    <th class="column6">Sakit</th>
                    <th class="column7">Ijin</th>
                    <th class="column8">Alfa</th>
                    <th class="column9">Dalam ( Hari )</th>
                    <th class="column10">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" value="{{$i = 1}}">
                @foreach ($absensistaff as $item)
                <tr>
                <input type="hidden" value="{{$item->id_staff}}">
                <td>{{$i++}}</td>
                @if ($item->jenis_kelamin == "P")
                    <td>{{$item->nama_staff}} ( Perempuan )</td>
                @else
                <td>{{$item->nama_staff}} ( Laki-Laki )</td>
                @endif
                <td>{{$item->alamat}}</td>
                <td>{{$item->nomor_telepon}}</td>
                <td>{{ round(( $item->masuk / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                <td>{{ round(( $item->sakit / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                <td>{{ round(( $item->ijin / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                <td>{{ round(( $item->alfa / ( $item->masuk + $item->sakit + $item->ijin + $item->alfa ) ) * 100)}} %</td>
                <td>{{$item->masuk + $item->sakit + $item->ijin + $item->alfa}} Hari</td>
                <td><a type="button" href="/absenstaff/destroy/{{$item->id_absensi_staff}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop