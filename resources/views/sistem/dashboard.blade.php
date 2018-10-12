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
        <a href="{{url('/antrian')}}" class="small-box-footer">
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

  <hr style="border: 5px solid #1c7bd9; border-radius: 5px">
  <br>
  <div class="row">
    <div class="col-md-6">
      <form id="my_form" method="GET" action="{{url('/')}}" enctype="multipart/form-data">
      <div class="col-md-6 col-sm-9 col-xs-9">
      <select name="filtertahun" class="form-control" id="exampleFormControlSelect1">
        <option>-- Pilih tahun --</option>
        @for ($i=date('Y'); $i >= 2017 ; $i--)
        <option>{{$i}}</option>
        @endfor
      </select>
      </div>
      <button class="btn btn-success">cari</button>
      </form>
      <br>
      <div class="panel panel-default">
        <div id="pendapatan_tahunini" class="panel-body">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <form id="my_form" method="GET" action="{{url('/')}}" enctype="multipart/form-data">
      <div class="col-md-6 col-sm-9 col-xs-9">
      <select name="filterbulan" class="form-control" id="exampleFormControlSelect1">
        <option value="0">-- Pilih bulan --</option>
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
      </select>
      </div>
      <button class="btn btn-success">cari</button>
      </form>
      <br>
      <div class="panel panel-default">
        <div id="pendapatan_bulanini" class="panel-body">
        </div>
      </div>
    </div>
  </div> 
  <hr style="border: 5px solid #1c7bd9; border-radius: 5px">
  <br>
  <div class="row">
    <div class="col-md-6">
      <form id="my_form" method="GET" action="{{url('/')}}" enctype="multipart/form-data">
      <div class="col-md-6 col-sm-9 col-xs-9">
      <select name="filter_tahun" class="form-control" id="exampleFormControlSelect1">
        <option>-- Pilih tahun --</option>
        @for ($i=date('Y'); $i >= 2017 ; $i--)
        <option>{{$i}}</option>
        @endfor
      </select>
      </div>
      <button class="btn btn-success">cari</button>
      </form>
      <br>
      <div class="panel panel-default">
        <div id="berat_tahunini" class="panel-body">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <form id="my_form" method="GET" action="{{url('/')}}" enctype="multipart/form-data">
      <div class="col-md-6 col-sm-9 col-xs-9">
      <select name="filter_tahun" class="form-control" id="exampleFormControlSelect1">
        <option>-- Pilih tahun --</option>
        @for ($i=date('Y'); $i >= 2017 ; $i--)
        <option>{{$i}}</option>
        @endfor
      </select>
      </div>
      <button class="btn btn-success">cari</button>
      </form>
      <br>
      <div class="panel panel-default">
        <div id="kiloan_satuan" class="panel-body">
        </div>
      </div>
    </div>
  </div>     
  
</div>


@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
  $(function () { 
    var myChart = Highcharts.chart('pendapatan_tahunini', {
        chart: {
            type: 'areaspline'

        },
        title: {
            text: 'Pendapatan tahun {!! $tahun_ini !!}'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            title: {
                text: 'Nominal Pendapatan (Rp)'
            }
        },
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            name: 'Pendapatan',
            data: {!! $nominal_tahunini !!},
            color : '#00a65a'
        }]
    });
});
</script>

<script type="text/javascript">
  $(function () { 
    var myChart = Highcharts.chart('pendapatan_bulanini', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Pendapatan bulan {!! $bulan_ini !!}'
        },
        xAxis: {
            categories: {!! $tanggal !!}
        },
        yAxis: {
            title: {
                text: 'Nominal Pendapatan (Rp)'
            }
        },
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            name: 'Pendapatan',
            data: {!! $nominal_bulanini !!},
             color : '#dd4b39'
        }]
    });
});
</script>

<script type="text/javascript">
  $(function () { 
    var myChart = Highcharts.chart('berat_tahunini', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Total Berat Laundry Kiloan tahun {!! $tahun_ini !!}'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            title: {
                text: 'berat (kg)'
            }
        },
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
        series: [{
            name: 'Laundry Kiloan',
            data: {!! $berat_tahunini !!},
            color : '#3c8dbc'
        }]
    });
});
</script>

<script type="text/javascript">
  $(function () { 
    var myChart = Highcharts.chart('kiloan_satuan', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Pendapatan Kiloan & Satuan Tahun {!! $tahun_ini !!}'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
        },
        yAxis: {
            title: {
                text: 'Nominal Pendapatan (Rp)'
            }
        },
        plotOptions: {
            column: {
              
                borderWidth: 0,
                groupPadding: 0,
                shadow: true
            }
        },
        series: [{
            name: 'Laundry Kiloan',
            data: {!! $pendapatan_kiloan !!},
            color : '#f39c12'
        }, {
            name: 'Laundry Satuan',
            data: {!! $pendapatan_satuan !!},
            color : '#337ab7'
        }]
    });
});
</script>
@endsection