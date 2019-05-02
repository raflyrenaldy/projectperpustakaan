@extends('adminlte::page')

@section('title', 'Anggota')

@section('content')

<section class="content-header">
    <h1>
      Detail Member
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{route('member')}}">Member</a></li>
      <li class="active">Detail Member</li>
    </ol>
  </section>

<div class="box box-primary">
    <div class="box-body box-profile">


      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
        <b>Nama</b> <a class="pull-right">{{ $member->name}}</a>
        </li>
        <li class="list-group-item">
          <b>NIS</b> <a class="pull-right">{{ $member->nis}}</a>
        </li>
        <li class="list-group-item">
          <b>Email</b> <a class="pull-right">{{ $member->email}}</a>
        </li>
        <li class="list-group-item">
            <b>Alamat</b> <a class="pull-right">{{ $member->address}}</a>
          </li>
      </ul>

      <a href="{{route('editmember',$member->nis)}}" class="btn btn-primary btn-block"><b>Update</b></a>
    </div>
    <!-- /.box-body -->
  </div>
@stop

