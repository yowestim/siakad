@extends('apps.layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Add Nilai</h3>
    </div>
    <div class="box-body">
        <form method="post" action="{{url('nilai/save')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <select name="siswa" class="form-control" placeholder="SISWA" required> 

                @foreach($dataSiswa as $item)
                   <option value="{{$item->id_siswa}}">{{$item->nama_siswa}}</option> 

                @endforeach
                
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="uts" class="form-control" placeholder="UTS" required>
            </div>

            <div class="form-group">
                <input type="number" name="uas" class="form-control" placeholder="UAS" required>
            </div>

            <div class="form-group">
                <input type="number" name="harian" class="form-control" placeholder="HARIAN" required>
            </div>

            <div class="form-group">
                <input type="number" name="hasil_akhir" class="form-control" placeholder="HASIL AKHIR" required>
            </div>

            <div class="form-group" style="float:right">
                <a href="{{url('nilai')}}" class="btn btn-light">Kembali</a>
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
