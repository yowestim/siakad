@extends('apps.layout')
@section('content')
<script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
rel="stylesheet">
</script>
<style>
.infox{
  box-shadow: 0 1px 1px rgba(0,0,0,.1);
          height: 80px;
          display: flex;
          cursor: default;
          background-color: #fff;
          position: relative;
          overflow: hidden;
          margin-bottom: 30px;
          padding: 5px;
          border-radius: 50px;
}
.infox .content{
  display: inline-block;
    padding: 7px 10px;
}
.infox .content .text{
  font-size: 13px;
    margin-top: 5px;
    color: #555;
}
.infox .content .num{
  font-weight: normal;
    font-size: 26px;
    margin-top: -4px;
    color: #555;
}
.infox .icon {
    display: inline-block;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.12);
    width: 70px;
    border-radius: 100%;
}
.infox .icon i {
    color: #fff;
    padding: 1px;
    font-size: 50px;
    line-height: 75px;
}
.material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 20px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}
.bg-red {
    background-color: #F44336 !important;
    color: #fff;
}
.bg-green {
    background-color: #4CAF50 !important;
    color: #fff;
}
.bg-yellow {
    background-color: #FFBB00 !important;
    color: #fff;
}
.bg-orange {
    background-color: #FF7700 !important;
    color: #fff;
}
.bg-blue {
    background-color: #2196F3 !important;
    color: #fff;
}
.bg-purple {
    background-color: #9C27B0 !important;
    color: #fff;
}
</style> 
    <h3>Selamat Datang {{$gils->nama_staff}}</h3><br>
    @if(($gils->masuk + $gils->sakit + $gils->ijin + $gils->alfa) != 0)
    <input value="{{$muasuk = round($gils->masuk / ($gils->masuk + $gils->sakit + $gils->ijin + $gils->alfa) * 100)}}" hidden>
    <div class="row">
    @if($muasuk >= 90 && $muasuk <= 100)
      <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="infox bg-green">
        <div class="icon">
            <i><span class="fa fa-user"></span></i>
        </div>
        <div class="content">
          <div class="text" style="color:#fff">NILAI PRESENSI</div>
              <div class="num" style="color:#fff">
                BAIK SEKALI
              </div>
          </div>
      </div>
    </div>
    @elseif($muasuk >= 80 && $muasuk < 90)
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="infox bg-blue">
        <div class="icon">
            <i><span class="fa fa-user"></span></i>
        </div>
        <div class="content">
          <div class="text" style="color:#fff">NILAI PRESENSI</div>
              <div class="num" style="color:#fff">
                BAIK
              </div>
          </div>
      </div>
    </div>
    @elseif($muasuk >= 60 && $muasuk < 80)
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="infox bg-yellow">
        <div class="icon">
            <i><span class="fa fa-user"></span></i>
        </div>
        <div class="content">
          <div class="text" style="color:#fff">NILAI PRESENSI</div>
              <div class="num" style="color:#fff">
                CUKUP
              </div>
          </div>
      </div>
    </div>
    @elseif($muasuk >= 40 && $muasuk < 60)
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="infox bg-orange">
        <div class="icon">
            <i><span class="fa fa-user"></span></i>
        </div>
        <div class="content">
          <div class="text" style="color:#fff">NILAI PRESENSI</div>
              <div class="num" style="color:#fff">
                BURUK
              </div>
          </div>
      </div>
    </div>
    @elseif($muasuk >= 0 && $muasuk < 40)
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="infox bg-red">
        <div class="icon">
            <i><span class="fa fa-user"></span></i>
        </div>
        <div class="content">
          <div class="text" style="color:#fff">NILAI PRESENSI</div>
              <div class="num" style="color:#fff">
                BURUK SEKALI
              </div>
          </div>
      </div>
    </div>
    @endif
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="infox bg-purple">
        <div class="icon">
            <i><span class="fa fa-user"></span></i>
        </div>
        <div class="content">
          <div class="text" style="color:#fff">KEHADIRAN</div>
              <div class="num" style="color:#fff">
                {{$muasuk}}
                <small>%</small>
              </div>
          </div>
      </div>
    </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="infox">
          <div class="icon bg-green">
            <i><span class="fa fa-user"></span></i>
          </div>
          <div class="content">
              <div class="text">MASUK</div>
              <div class="num">{{$gils->masuk}}
              <small>Hari</small>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="infox">
          <div class="icon bg-orange">
            <i><span class="fa fa-user"></span></i>
          </div>
          <div class="content">
              <div class="text">SAKIT</div>
              <div class="num">{{$gils->sakit}}
              <small>Hari</small>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="infox">
          <div class="icon bg-blue">
            <i><span class="fa fa-user"></span></i>
          </div>
          <div class="content">
              <div class="text">IJIN</div>
              <div class="num">{{$gils->ijin}}
              <small>Hari</small>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="infox">
          <div class="icon bg-red">
            <i><span class="fa fa-user"></span></i>
          </div>
          <div class="content">
              <div class="text">ALFA</div>
              <div class="num">{{$gils->alfa}}
              <small>Hari</small>
              </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="col-md-12 bg-orange" style="border-radius: 20px;margin-bottom: 20px;padding:10px">Belum Input Absen</div>
    @endif
@endsection
@section('logout')
<li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{$gils->nama_staff}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

            <p>
              {{$gils->nama_staff}}
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
              <a href="{{url('/logoutstaff')}}" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
@endsection
@section('name')
    {{$gils->nama_staff}}
@endsection