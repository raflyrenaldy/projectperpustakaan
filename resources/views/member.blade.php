@extends('adminlte::page')

@section('title', 'Anggota')

@section('content')
<section class="content-header">
    <h1>
      Data Member
    </h1>
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Member</li>
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
            <h3 class="box-title">Data Member</h3><br><br>
<a href="{{route('createmember')}}"class="btn btn-xs btn-success">
                           Tambah Member <i class="fa fa-plus"></i>
                      </a>
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
              <th>NIS</th>
               <th>Nama</th>
              <th>No Telp</th>
              <th>Aksi</th>
              </tr>
              </thead>

              <tbody>
                    <?php $i=1; ?>
                    @foreach($member as $datas)
              <tr>
                <td>{{$i}}</td>
                <td>{{ $datas->nis}}</td>
                <td>{{ $datas->name}}</td>
                <td>{{ $datas->phone}}</td>
                <td align="center">
                <a class="fa fa-edit" href="{{route('editmember',$datas->nis)}}">

                  </a>
                   |
                <a class="fa fa-eye" href="{{ route('detailmember',$datas->nis) }}"></a> |
                  <a type="button" data-toggle="modal" data-target="#delete" class="fa fa-trash" data-id="{{$datas->id}}" data-title="{{$datas->foto}}" data-body="{{$datas->keterangan}}"></a>

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
        @if($member->count() == 0)
        @else
      <form class="form-horizontal" role="modal"  action="{{route('deletemember',$datas->nis)}}" method="post">
{{method_field('delete')}}
        @endif
          {{csrf_field()}}
        <input type="hidden" id="id" name="id" value"">

        <h5>Anda yakin menghapus data ini?</h5>

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
@Stop

@Push('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js')

