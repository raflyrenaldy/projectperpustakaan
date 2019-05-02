@extends('adminlte::page')

@section('title', 'Anggota')

@section('content')
<section class="content-header">
    <h1>
      Tambah Member
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('member')}}">Member</a></li>
      <li class="active">Tambah Member</li>
    </ol>
  </section>

<section class="content">
<!-- /.col -->
     <!-- /.col -->

        <div class="box box-warning ">
          <div class="box-header with-border">
@if($errors->count() > 0)
<div id="ERROR_COPY" class="alert alert-danger">
@foreach($errors->all() as $error)
{{$error}} <br>
@endforeach
</div>
@endif
@if (session()->has('success_message'))
              <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {{ session()->get('success_message') }}
                  </div>
            @endif
            @if (session()->has('error_message'))
              <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {{ session()->get('error_message') }}
                  </div>
            @endif
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
             <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('addmember')}}">

              {{csrf_field()}}
                <input type="hidden" id="id1" name="id1" value"">

           <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label" align="right">NIS</label>
                      <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="" value="{{ old('nis') }}">
                            <span id="error_nis"></span>
               <p class="error text-center alert alert-danger hidden"></p>
                         </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Nama</label>
                    <div class="col-sm-10">
                          <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="{{ old('nama') }}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">No HP</label>
                    <div class="col-sm-10">
                          <input type="number" class="form-control" id="phone" name="phone" placeholder="" value="{{ old('phone') }}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>

            <div class="form-group row">
                    <label for="inputPassword" class="col-md-2 col-form-label" align="right">Alamat</label>
                <div class="col-sm-10">

                  <textarea id="alamat" name="alamat" value="{{ old('alamat') }}" rows="5" cols="142">

                  </textarea>
                  <p class="error text-center alert alert-danger hidden"></p>
                </div>
          <!-- /.box-body -->
            </div>

            {{-- <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Email</label>
                    <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ old('email') }}">
                          <span id="error_email"></span>
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div> --}}

        <div class="form-group row">
          <label for="inputPassword" class="col-md-2 col-form-label" align="right"></label>
    <div class="col-md-10">
        <button class="btn btn-info" type="submit" name="submit" id="submit">
            <span class="glyphicon glyphicon-plus"></span> Save Post
          </button>
        </div>
        </div>
      </div>
       </form>

      <!-- /.col -->
    <!-- ./row -->
</div>

    <!-- /.row -->
  </section>

<script src="{{asset('js/app.js')}}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
@if($errors->count() > 0)
    swal({
title: "Error!",
text: jQuery("#ERROR_COPY").html(),
icon: "error",
  @endif

});

</script>
<script>
    $(document).ready(function(){

     $('#nis').blur(function(){
      var error_nis = '';
      var nis = $('#nis').val();
      var _token = $('input[name="_token"]').val();

       $.ajax({
        url:"{{ route('nis.check') }}",
        method:"POST",
        data:{nis:nis, _token:_token},
        success:function(result)
        {
            if(result == 'unique')
 {
  $('#error_nis').html('<label class="text-success">NIS Tersedia</label>');
  $('#nis').removeClass('has-error');
  $('#submit').attr('disabled', false);
 }
 else
 {
  $('#error_nis').html('<label class="text-danger">NIS Sudah Ada</label>');
  $('#nis').addClass('has-error');
  $('#submit').attr('disabled', 'disabled');
 }
        }
       })

     });

    });
    </script>


@stop
