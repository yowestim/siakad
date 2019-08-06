@extends('apps.layout')
@section('content')
<h3>Selamat Datang {{$soden->nama_siswa}}</h3>
<a href="{{url('siswa/tpb')}}" class="btn btn-primary">Pinjam Buku</a>
@endsection
@section('logout')
<li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{$data}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

            <p>
              {{$data}}
              <small>Member since Nov. 2012</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{url('/logoutsiswa')}}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
@endsection
@section('name')
    {{$data}}
@endsection