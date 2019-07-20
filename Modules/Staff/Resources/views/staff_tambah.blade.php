@extends('apps.layout')

@section('content')
    <h1>Staff</h1>

    <p>
        This view is loaded from module: {!! config('staff.name') !!}
    </p>
<div class="box box-header">
    <div class="box-body">
           <div class="box-header">
              <h2 class="box-title">Add Staff</h2>
            </div>
            <form method="post" action="{{url('staff/save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
           <div class="col-md-6">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" id="nama_staff" name="nama_staff" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Staff .." required></textarea>
                </div>
                <div class="form-group">
                        <label>Nomor Telepon</label>
                    <input type="number" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon">
                </div>
              </div>
           </div>
           <div class="col-md-6">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                          <option value="">Pilih</option>
                          <option value="L">Laki - Laki</option>
                          <option value="P">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" id="foto" name="foto"  onchange="sendImages(this)">
                    </div>
                    <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                        </div>
                        <div class="form-group" align="center" style="border-style: groove;">
                            <img src="" id="viewImages" style="padding:1%;max-height: 250px; max-width: 250px;">
                          </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button style="float:right;margin-left:2%;" type="submit" class="btn btn-primary">Submit</button>
                    <button style="float:right" onclick="window.location.href='{{url('staff')}}'" type="button" class="btn btn-danger">Cancel</button>
                  </div>


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
