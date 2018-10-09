@extends('layout.sistem')
@section('title', 'Laundry')

@section('content')
<div class="container">
	<h3>Dashboard</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>{{$berat_bulanini}}<sup style="font-size: 20px">kg</sup></h4>
              <br>
              <p>Laundry bulan ini</p>
            </div>
            <div class="icon" style="margin-top: -10px">
              <i class="fas fa-tshirt"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
          <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4>{{$antrian}}</h4>
              <br>
              <p>Antrian</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp</sup> {{number_format($pendapatan_hariini)}}</h4>
              <br>
              <p>Pendapatan hari ini</p>
            </div>
            <div class="icon" style="margin-top: -5px">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('/laporan_hariini')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp</sup> <b>{{number_format("$pendapatan_bulanini",0,",",".")}}</b></h4>
              <br>
              <p>Pendapatan bulan ini</p>
            </div>
            <div class="icon">
            	<i class="ion ion-stats-bars"></i>
              
            </div>
            <a href="{{url('/laporan')}}" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
  
</div>


@endsection