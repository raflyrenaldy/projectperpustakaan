@extends('adminlte::page')

@section('title', 'Pengembalian')

@section('content')
<style>
.bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
    background-color: #d6570d !important;
}
</style>
<section class="content-header">
    <h1>
      Detail Pengembalian
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('return')}}">Pengembalian</a></li>
      <li class="active">Detail Pengembalian</li>
    </ol>
  </section>

<div class="box box-primary">
    <div class="box-body box-profile">
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

      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
        <b>Nama Peminjam</b> <a class="pull-right">{{ $borrow->get_member->name}}</a>
        </li>
        <li class="list-group-item">
        <b>NIS Peminjam</b> <a class="pull-right">{{ $borrow->get_member->nis}}</a>
        </li>
        <li class="list-group-item">
          <b>Tanggal Pinjam</b> <a class="pull-right">{{ $borrow->tgl_pinjam->format('d, M Y')}}</a>
        </li>
        <li class="list-group-item">
          <b>Tanggal Kembali</b> <a class="pull-right">{{ $borrow->tgl_kembali->format('d, M Y')}}</a>
        </li>
        <li class="list-group-item">
            <b>Tanggal Diterima</b> <a class="pull-right">{{ $return->tgl_diterima->format('d, M Y')}}</a>
          </li>
        @if($return->denda > 0)
        <li class="list-group-item">
                <b>Total Denda</b> <a class="pull-right">Rp. {{ $return->denda }}</a>
        </li>
        @endif
      </ul>
      {{-- <div class="row"> --}}
          {{-- <div class="col-md-6"> --}}

      {{-- <a href="{{route('editborrow',$borrow->id)}}" class="btn btn-primary btn-block"><b>Perbarui</b></a> --}}
    {{-- </div> --}}
          {{-- <div class="col-md-6"> --}}
            @if($borrow->status == 0)
      <a href="{{route('returnedbook',$borrow->id)}}" class="btn btn-success btn-block"><b>Dikembalikan</b></a>
        @else
                <a href="{{route('cancelreturn',$borrow->id)}}" class="btn btn-success btn-block"><b>Batal Dikembalikan</b></a>
        @endif
    {{-- </div> --}}
      {{-- </div> --}}
    </div>
    <!-- /.box-body -->
  </div>

  <div class="box-body">
    @foreach ($loaned_book as $loan)
        @if($loan->status == 0)
    <div class="alert alert-success alert-dismissible">
        @if($denda > 0)
        <a class="fa fa-check pull-right" title="Kembalikan"></a>
        @else
        <a class="fa fa-check pull-right" href="{{route('returnonebook',$loan->id)}}"  title="Kembalikan"></a>
        @endif
    @else
    <div class="alert alert-info alert-dismissible">
            <span class="label label-danger pull-right">Sudah Dikembalikan</span>
    @endif
        <h4><i class="icon fa fa-book"></i> {{$loan->get_book->name}}</h4>
      {{$loan->get_book->pengarang}}, {{$loan->get_book->penerbit}} - {{$loan->get_book->tahun_terbit}}
    </div>
    @endforeach
  </div>
@stop

