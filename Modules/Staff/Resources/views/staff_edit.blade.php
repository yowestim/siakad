@extends('apps.layout')

@section('content')
    <h1>CRUD Data Staff</h1>

    <p>
        This view is loaded from module: {!! config('staff.name') !!}
    </p>
<div class="box box-header">
    <div class="box-body">
           <div class="box-header">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <form method="post" action="{{url('/staff/update').'/'.$staff->id_staff }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
           <div class="col-md-6">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" value="{{$staff->nama_staff}}" class="form-control" id="nama_staff" name="nama_staff" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Staff .." required>{{$staff->alamat}}</textarea>
                </div>
                <div class="form-group">
                        <label>Nomor Telepon</label>
                    <input type="number" value="{{$staff->nomor_telepon}}" class="form-control" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon">
                </div>
              </div>
           </div>
           <div class="col-md-6">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="" <?php if($staff->jenis_kelamin == "") { echo "SELECTED"; } ?>>Pilih</option>
                            <option value="L" <?php if($staff->jenis_kelamin == "L") { echo "SELECTED"; } ?>>Laki - Laki</option>
                            <option value="P" <?php if($staff->jenis_kelamin == "P") { echo "SELECTED"; } ?>>Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" name="foto" id="foto" onchange="sendImages(this)">
                            <input value="{{$staff->foto}}" type="hidden" name="foto_old" id="foto_old">
                    </div>
                    <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                        </div>
                        <div class="form-group" align="center" style="border-style: groove;">
                            <img src="{{asset('images/staff').'/'.$staff->foto}}" id="viewImages" style="padding:1%;max-height: 250px; max-width: 250px;">
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

