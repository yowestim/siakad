@extends('apps.layout')
@section('content')
<h3>Anda Guru!</h3>
<form action="{{url('testnotif')}}" class="appointment-form" method="get">
  <div class="main">
    <div class="container">
      <div class="form-group">
        <div class="select-list">
          <h3>Roles</h3>
          <select onchange="pilih()" name="roles" id="roles">
            <option selected value="" disabled>Pilih Role . . .</option>
            <option name="id_siswa" value="1">Siswa</option>
            <option name="id_staff" value="2">Staff</option>
          </select>
        </div>
        <div id="siswa">
          <select name="id_siswa">
            @foreach ($dataSiswa as $item)
            <option value="{{$item->id_siswa}}">{{$item->nama_siswa}}</option>
            @endforeach
          </select>
          <label>Deskripsi</label>
          <input type="text" name="deskripsisiswa">
        </div>
        <div id="staff">
          <label>Deskripssi</label>
          <input type="text" name="deskripsistaff">
        </div>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-info">Tes Notif</button>
</form>
</form>
@endsection
@section('name')
{{$data}}
@endsection
@section('navbar')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-notifications.min.css')}}">

{{-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> --}}

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Demo App</a>
    </div>

    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown dropdown-notifications">
          <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
            <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
          </a>

          <div class="dropdown-container">
            <div class="dropdown-toolbar">
              <div class="dropdown-toolbar-actions">
                <a href="#">Mark all as read</a>
              </div>
              <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
            </div>
            <ul class="dropdown-menu">
            </ul>
            <div class="dropdown-footer text-center">
              <a href="#">View All</a>
            </div>
          </div>
        </li>
        <li><a href="#">Timeline</a></li>
        <li><a href="#">Friends</a></li>
      </ul>
    </div>
  </div>
</nav>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
  $( document ).ready(function() {            
             $('#siswa').hide();
             $('#staff').hide();
        });

    function pilih(){
        var change = $('#roles').val();
        if(change == 1){
        $('#siswa').show();
        $('#staff').hide();
        }else{
        $('#siswa').hide();            
        $('#staff').show();
        }
    }
      var notificationsWrapper   = $('.dropdown-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = notificationsToggle.find('i[data-count]');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = notificationsWrapper.find('ul.dropdown_menu');

      if (notificationsCount <= 0) {
        notificationsWrapper.hide();
      }

      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      var pusher = new Pusher('291b742b286d369fb376', {
        cluster: 'ap1',
        forceTLS: true,
        encrypted: true
      });

      // Subscribe to the channel we specified in our Laravel Event
      var channel = pusher.subscribe('notifikasi');
      // Bind a function to a Event (the full Laravel class)
      channel.bind('Modules\\Auth\\Events\\Notifikasi', function(data) {
        var existingNotifications = notifications.html();
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
                <div class="media-left">
                  <div class="media-object">
                    <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                  </div>
                </div>
                <div class="media-body">
                  <strong class="notification-title">`+data.message+`</strong>
                  <!--p class="notification-desc">Extra description can go here</p-->
                  <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                  </div>
                </div>
              </div>
          </li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
      });
</script>
@endsection