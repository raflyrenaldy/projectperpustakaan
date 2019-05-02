@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<section class="content-header">
    <h1>
      Edit Peminjaman
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('borrow')}}">Peminjaman</a></li>
      <li class="active">Edit Peminjaman +</li>
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
             <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('updateborrow',$borrow->id)}}">

              {{csrf_field()}}
                <input type="hidden" id="id1" name="id1" value"">



            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Anggota</label>
                    <div class="col-sm-10">
                            <select class="form-control select2" style="width: 100%;" name="id_anggota" id="id_anggota">
                            <option selected="selected" value="{{$borrow->id_anggota}}">{{$borrow->get_member->name}} - {{$borrow->get_member->nis}}</option>
                                    @foreach($member as $datas)
                                                <option value={{$datas->id}}>{{$datas->name}} - {{$datas->nis}}</option>
                                            @endforeach
                                  </select>
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>
            <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Tanggal Pinjam</label>
                        <div class="col-sm-10">
                                <input type="date" class="form-control pull-right" id="tgl_pinjam" name="tgl_pinjam" value="{{$borrow->tgl_pinjam->format('Y-m-d')}}">
                 <p class="error text-center alert alert-danger hidden"></p>
                           </div>
                </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Tanggal Kembali</label>
                    <div class="col-sm-10">
                            <input type="date" class="form-control pull-right" id="tgl_kembali" name="tgl_kembali" value="{{$borrow->tgl_kembali->format('Y-m-d')}}">
             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
            </div>

        <div class="form-group row">
          <label for="inputPassword" class="col-md-2 col-form-label" align="right"></label>
    <div class="col-md-10">
        <button class="btn btn-info" type="submit" name="submit" id="submit">
             Simpan Perubahan
          </button>
        </div>
        </div>
      </div>
       </form>



      <!-- /.col -->
    <!-- ./row -->
</div>
@php
 $i = 1;
@endphp
@foreach($loaned_book as $key)
<div class="box box-info ">
        <div class="box-header with-border">
                <h3 class="box-title">Buku {{$i}}</h3><br><br>
<div class="box-body">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('updateloanedbook',$key->id)}}">

         {{csrf_field()}}

           <input type="hidden" id="id1" name="id1" value="{{$key->id}}">

       <div class="form-group row">
           <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Nama Buku</label>
               <div class="col-sm-10">
                       <select class="form-control select2" style="width: 100%;" name="id_buku" id="id_buku">
                       <option value={{$key->get_book->id}}>{{$key->get_book->name}}, {{$key->get_book->pengarang}} - {{$key->get_book->penerbit}}</option>
                               @foreach($book as $datas)
                                           <option value={{$datas->id}}>{$datas->name}}, {{$datas->pengarang}} - {{$datas->penerbit}}</option>
                                @endforeach
                             </select>
        <p class="error text-center alert alert-danger hidden"></p>
                  </div>
       </div>

   <div class="form-group row">
     <label for="inputPassword" class="col-md-2 col-form-label" align="right"></label>
<div class="col-md-10">
   <button class="btn btn-info" type="submit" name="submit" id="submit">
        Simpan Perubahan Buku
     </button>
    </form>
   </div>
   </div>
 </div>
</div>
</div>
@php
  $i++;
@endphp
@endforeach

<button class="btn btn-info btn-block" onclick="addBook()" id="buttonBook">Tambah Buku</button>

<div class="box box-info " style="display:none" id="boxBook">
        <div class="box-header with-border">
                <h3 class="box-title">Tambah Buku</h3><br><br>
<div class="box-body">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{route('addloanedbook',$borrow->id)}}">

         {{csrf_field()}}

           <input type="hidden" id="id1" name="id1" value="">

           <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" align="right">Nama Buku</label>
                    <div class="col-sm-10">
                                  <select class="form-control select2" multiple="multiple" data-placeholder="Pilih Buku"
                                          style="width: 100%;" name="id_buku[]" id="id_buku">
                                          @foreach($book as $datas)
                                              <option value="{{$datas->id}}">{{$datas->name}}, {{$datas->pengarang}} - {{$datas->penerbit}}</option>
                                          @endforeach
                                  </select>

             <p class="error text-center alert alert-danger hidden"></p>
                       </div>
          </div>

   <div class="form-group row">
     <label for="inputPassword" class="col-md-2 col-form-label" align="right"></label>
<div class="col-md-10">
   <button class="btn btn-info" type="submit" name="submit" id="submit">
        Save Post
     </button>
    </form>
   </div>
   </div>
 </div>
</div>
</div>
<button class="btn btn-danger btn-block" style="display:none" onclick="cancel()" id="cancelBook">Batal</button>
    <!-- /.row -->
  </section>

<script src="{{asset('js/app.js')}}"></script>
<script>

function addBook() {
  var x = document.getElementById("boxBook");
  var y = document.getElementById("buttonBook");
  var z = document.getElementById("cancelBook");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "block";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";
  }
}

function cancel() {
  var x = document.getElementById("boxBook");
  var y = document.getElementById("buttonBook");
  var z = document.getElementById("cancelBook");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "block";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";
  }
}


</script>
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
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date range picker
          $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
          //Date range as a button
          $('#daterange-btn').daterangepicker(
            {
              ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
            function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
          )

          //Date picker
          $('#datepicker').datepicker({
            autoclose: true
          })

          //iCheck for checkbox and radio inputs
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
          })
          //Red color scheme for iCheck
          $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
          })
          //Flat red color scheme for iCheck
          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
          })

          //Colorpicker
          $('.my-colorpicker1').colorpicker()
          //color picker with addon
          $('.my-colorpicker2').colorpicker()

          //Timepicker
          $('.timepicker').timepicker({
            showInputs: false
          })
        })
      </script>
@stop
@Push('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js')
@Push('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css')
