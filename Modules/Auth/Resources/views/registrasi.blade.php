<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi</title>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <div class="container">
            <form method="POST" class="appointment-form" action="{{url('registrasi/post')}}" novalidate>
                @csrf
                <h2>Sign Up</h2>
                <div class="form-group">
                    <div class="select-list">
                        <h3>Roles</h3>
                        <select onchange="tampil()" name="roles" id="roles">
                            @foreach ($data as $item)                                
                                <option  name="id_roles" value="{{$item->id_roles}}">{{$item->nama_roles}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="changenonsiswa">
                        <input type="text" name="namee" id="namee" placeholder="Your Name" required />                        
                        <input type="text" name="addresss" id="addresss" placeholder="Your Address" required />
                        <input type="text" name="usernamee" id="usernamee" placeholder="Username" required />
                        <input type="password" name="passwordd" id="passwordd" placeholder="Password" required />
                        <input type="number" name="nomorr" id="nomorr" placeholder="Phone number" required />
                    </div>
                    <div id="changesiswa">
                            <input type="text" name="name" id="name" placeholder="Your Name" required />                        
                            <input type="text" name="address" id="address" placeholder="Your Address" required />
                            <input type="text" name="username" id="username" placeholder="Username" required />
                            <input type="password" name="password" id="password" placeholder="Password" required />
                            <input type="number" name="nomor" id="nomor" placeholder="Phone number" required />
                            <div class="select-list">
                                <h3>Nama Kelas</h3>
                                    <select name="kelas" id="kelas">
                                        @foreach ($kelas as $item)                                
                                            <option name="id_kelas" required value="{{$item->id_kelas}}">{{$item->nama_kelas}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    <div id="jk" class="select-list">
                        <h3>Jenis Kelamin</h3>
                        <select name="jk" id="jk">                                                     
                            <option value="L">Laki Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>                
                <div class="form-submit">
                    <input type="submit" name="submit" id="submit" class="submit" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $( document ).ready(function() {            
             $('#changenonsiswa').hide();
             $('#changesiswa').hide();
             $('#jk').hide();
        });
        
        function tampil(){
            var change = $('#roles').val();
            if(change == 5){
            $('#changesiswa').show();
            $('#jk').show();
            $('#changenonsiswa').hide();
            }else{
            $('#changenonsiswa').show();            
            $('#jk').show();            
            $('#changesiswa').hide();
            }
        }
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>