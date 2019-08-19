<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Tambah Data Staff</title>
        <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data STAFF - <strong>TAMBAH DATA STAFF</strong>
                </div>
                <div class="card-body">
                    <a href="{{url('staff')}}" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>

                    <form method="post" action="{{url('staff/save')}}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_staff" class="form-control" placeholder="Nama Staff .." required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat Staff .." required></textarea>
                        </div>

                        <div class="form-group">
                            <label>No. Telp</label>
                            <input type="text" name="nomor_telepon" class="form-control" placeholder="No. Telp .." required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin">
                                <option value="">Pilih</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>

                              </select>
                        </div>

                        <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control" onchange="sendImages(this)">

                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="" id="viewImages" style="max-height: 100%; max-width: 100%;">
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
