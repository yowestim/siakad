@extends('apps.layout')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Add Data Buku</h3>
    </div>
    <div class="box-body">
        <form method="post" action="{{url('buku/update/save', $dataBuku->id_buku)}}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
            <input type="text" name="judul_buku" value="{{$dataBuku->judul_buku}}" class="form-control" placeholder="Judul Buku" required></textarea>
            </div>

            <div class="form-group">
                <input type="text" name="isbn" value="{{$dataBuku->isbn}}" class="form-control" placeholder="ISBN" required></textarea>
            </div>

            <div class="form-group">
                <input type="text" name="pengarang" value="{{$dataBuku->pengarang}}" class="form-control" placeholder="Pengarang" required>
            </div>

            <div class="form-group">
                <input type="text" name="penerbit" value="{{$dataBuku->penerbit}}" class="form-control" placeholder="penerbit" required>
            </div>

            <div class="form-group">
                <input type="date" name="tanggal_terbit" value="{{$dataBuku->tanggal_terbit}}" class="form-control" placeholder="Tanggal Terbit" required>
            </div>

            <div class="form-group">
                <select class="form-control" name="klasifikasi" placeholder="Klasifikasi">
                    @foreach ($dataKlasifikasi as $klasifikasi)
                        <option value="{{$klasifikasi->id_klasifikasi}}"
                            @if ($dataBuku->id_klasifikasi == $klasifikasi->id_klasifikasi)
                                {{"selected"}}
                            @endif
                            >{{$klasifikasi->nama_klasifikasi}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="jumlah" value="{{$dataBuku->jumlah}}" class="form-control" placeholder="Jumlah" required>
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
