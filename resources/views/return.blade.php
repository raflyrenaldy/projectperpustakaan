@extends('adminlte::page')

@section('title', 'Pengembalian')

@section('content')
<section class="content-header">
    <h1>
      Data Pengembalian
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Pengembalian</li>
    </ol>
  </section>

<section class="content">
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
      <!-- /.col -->
    <!-- ./row -->

    <div class="row">
      <div class="col-xs-12">

        <!-- /.box -->

        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Data Peminjaman</h3><br><br>
{{-- <a href="{{route('createborrow')}}"class="btn btn-xs btn-success"> --}}
        {{-- Pengembalian <i class="fa fa-plus"></i> --}}
                      </a>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
               <th>Nama Peminjam</th>
              <th>NIS Peminjam</th>
              <th>Tgl Diterima</th>
              <th>Terlambat</th>
              <th>Denda</th>
              <th>Aksi</th>
              </tr>
              </thead>

              <tbody>
                    <?php $i=1; ?>
                    @foreach($return as $datas)
              <tr>
                <td>{{$i}}</td>
                <td>{{ $datas->get_borrow->get_member->name}}</td>
                <td>{{ $datas->get_borrow->get_member->nis}}</td>
                <td>{{ $datas->tgl_diterima->format('d, M Y')}}</td>
                @if($datas->telat == 1)
                <td><span class="label label-warning">Ya</span></td>
                <td>Rp. {{ $datas->denda }}</td>
                @else
                <td><span class="label label-info">Tidak</span></td>
                <td> - </td>
                @endif
                <td align="center">
                {{-- <a class="fa fa-edit" href="{{route('editborrow',$datas->id)}}">

                  </a> --}}
                   {{-- | --}}
                <a class="fa fa-eye" href="{{ route('detailreturn',$datas->id) }}"></a> |
                  <a type="button" data-toggle="modal" data-target="#delete" class="fa fa-trash" data-id="{{$datas->id}}"></a>

                </td>
              </tr>
              <?php $i++;
              ?>
              @endforeach
              </tbody>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>

<div id="delete"class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Konfimasi Hapus</h4>
    </div>
    <div class="modal-body">
        @if($return->count() > 0)
      <form class="form-horizontal" role="modal"  action="{{route('deletereturn',$datas->id)}}" method="post">
{{method_field('delete')}}
        @endif
          {{csrf_field()}}
        <input type="hidden" id="id" name="id" value"">

        <div class="form-group">
            <div class="col-md-10">
                <label>
                    <input type="checkbox" class="minimal-red" value="1" name="check">
                    Hapus semua data termasuk data peminjaman ?
                  </label>
            </div>

          </div>

    </div>
    <div class="modal-footer">

      <button type="submit" name="submit" class="btn actionBtn" >
        <span id="footer_action_button" class="glyphicon"></span>Hapus
      </button>

      <button type="button" class="btn btn-warning" data-dismiss="modal">
        <span class="glyphicon glyphicon"></span>close
      </button>
     </form>

    </div>
  </div>
</div>
</div>
                          </div>
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript">

$('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    })
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@stop
@section('js')
<script>
$(function () {

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
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

@Stop

@Push('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')
@Push('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css')
@Push('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js')


