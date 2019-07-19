@extends('apps.layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Add Data Buku</h3>
    </div>
    <div class="box-body">
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
@stop
@section('script')
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
@endsection
