@extends('adminlte::page')

@section('title', 'Dashboard')



@section('content')
<section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
<br><br>

<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$member}}</h3>

          <p>Anggota</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
        <h3>{{$book}}</h3>

          <p>Buku</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$borrow}}</h3>

          <p>Peminjaman</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$return}}</h3>

          <p>Return</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>

@stop
