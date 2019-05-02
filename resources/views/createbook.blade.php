@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<section class="content-header">
    <h1>
      Tambah Buku
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('book')}}">Buku</a></li>
      <li class="active">Tambah Buku</li>
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
             <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('addbook')}}">

              {{csrf_field()}}
                <input type="hidden" id="id1" name="id1" value"">

           <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Nama Buku</label>
                      <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ old('name') }}">
               <p class="error text-center alert alert-danger hidden"></p>
                         </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Penerbit</label>
                    <div class="col-sm-10">
                          <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="" value="{{ old('penerbit') }}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Pengarang</label>
                    <div class="col-sm-10">
                          <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="" value="{{ old('pengarang') }}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Tahun Terbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="" value="{{ old('tahun_terbit') }}" maxlength="4">                      <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>


            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Stock</label>
                    <div class="col-sm-10">
                          <input type="number" class="form-control" id="stock" name="stock" placeholder="" value="{{ old('stock') }}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Rak</label>
                    <div class="col-sm-10">
                          <input type="number" class="form-control" id="rak" name="rak" placeholder="" value="{{ old('rak') }}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>

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

    <script>
@if($errors->count() > 0)
    swal({
title: "Error!",
text: jQuery("#ERROR_COPY").html(),
icon: "error",
  @endif

});

</script>
    <script type="text/javascript">
     $( ".datepicker" ).datepicker({
      dateFormat: "yyyy",
    });
    </script>
@stop
