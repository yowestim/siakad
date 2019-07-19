<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Tutorial Laravel #21 : CRUD Eloquent Laravel - www.malasngoding.com</title>
        <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data STAFF - <strong>TAMBAH DATA STAFF</strong>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('staff/save')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="text" name="judul_buku" class="form-control" placeholder="Judul Buku" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="isbn" class="form-control" placeholder="ISBN" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" name="pengarang" class="form-control" placeholder="Pengarang" required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="penerbit" class="form-control" placeholder="penerbit" required>
                        </div>

                        <div class="form-group">
                            <input type="date" name="tanggal_terbit" class="form-control" placeholder="Tanggal Terbit" required>
                        </div>

                        <div class="form-group">
                          <select class="form-control" name="klasifikasi" placeholder="Klasifikasi">
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" required>
                        </div>

                        <div class="form-group" style="float:right">
                            <a href="{{url('buku')}}" class="btn btn-light">Kembali</a>
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
