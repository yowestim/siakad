<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>CRUD Eloquent Laravel</title>
        <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Staff - <strong>EDIT DATA STAFF</strong>
                </div>
                <div class="card-body">
                    <a href="{{url('staff')}}" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>


                    <form method="post" action="{{url('/staff/update').'/'.$staff->id_staff }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label>Nama Staff</label>
                            <input type="text" name="nama_staff" class="form-control" placeholder="Nama pegawai .." value=" {{ $staff->nama_staff }}">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat pegawai .."> {{ $staff->alamat }} </textarea>
                        </div>

                        <div class="form-group">
                                <label>No. Telp</label>
                                <input type="text" name="nomor_telepon" class="form-control" placeholder="No. Telp .." value="{{ $staff->nama_staff }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin">
                                    <option value="" <?php if($staff->jenis_kelamin == "") { echo "SELECTED"; } ?>>Pilih</option>
                                    <option value="L" <?php if($staff->jenis_kelamin == "L") { echo "SELECTED"; } ?>>Laki - Laki</option>
                                    <option value="P" <?php if($staff->jenis_kelamin == "P") { echo "SELECTED"; } ?>>Perempuan</option>

                                  </select>
                            </div>

                            <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control" onchange="sendImages(this)">
                                    <input value="{{$staff->foto}}" type="hidden" name="foto_old" id="foto_old">
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                                <img src="{{asset('images/staff').'/'.$staff->foto}}" id="viewImages" style="max-height: 100%; max-width: 100%;">
                                        </div>
                                    </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
<script>
        $(document).ready(function(){
            //  alert('kwkwkwk')
         })

       function sendImages(input) {
         if (input.files && input.files[0]) {
           var imgPath = $(input)[0].value;
           var extn = imgPath.substring(imgPath.lastIndexOf('.')+  1).toLowerCase();

           if(extn == 'jpg' || extn == 'jpeg' || extn == 'png'){
             var size = $(input)[0].size;
               var maxsize = 1024*1024; //1MB

               if (size < maxsize) {

                 var reader = new FileReader();

                 reader.onload = function (e) {
                   $("#viewImages").attr('src', e.target.result);
                 };

                 reader.readAsDataURL(input.files[0]);
               }
               else{
                 alert("Image Over 1MB");
               }
             }
             else{
               alert("Image Only !!");
               $("image").val("");
             }
           }
         }

     </script>

