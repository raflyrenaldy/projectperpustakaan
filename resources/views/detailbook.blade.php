@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')

<section class="content-header">
    <h1>
      Detail Buku
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('book')}}">Buku</a></li>
      <li class="active">Detail Buku</li>
    </ol>
  </section>

<div class="box box-primary">
    <div class="box-body box-profile">


      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
        <b>Nama Buku</b> <a class="pull-right">{{ $book->name}}</a>
        </li>
        <li class="list-group-item">
          <b>Pengarang</b> <a class="pull-right">{{ $book->pengarang}}</a>
        </li>
        <li class="list-group-item">
          <b>Penerbit</b> <a class="pull-right">{{ $book->penerbit}}</a>
        </li>
        <li class="list-group-item">
            <b>Tahun Terbit</b> <a class="pull-right">{{ $book->tahun_terbit}}</a>
        </li>
        <li class="list-group-item">
            <b>Stock</b> <a class="pull-right">{{ $book->stock}}</a>
        </li>
      </ul>

      <a href="{{route('editbook',$book->id)}}" class="btn btn-primary btn-block"><b>Update</b></a>
    </div>
    <!-- /.box-body -->
  </div>
@stop

