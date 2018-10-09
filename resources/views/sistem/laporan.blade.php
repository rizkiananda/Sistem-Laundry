@extends('layout.sistem')
@section('title', 'Laundry - laporan')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="container">
	<h3>Laporan Pendapatan</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>          

	<div class="row hidden-xs hidden-sm">
		<div class="col-md-4" style="border-right: 3px solid #1c7bd9;">
			<label>Pendapatan perhari</label>
			<div class="row">
				<form id="my_form" method="GET" action="{{url('/filtertanggal')}}" enctype="multipart/form-data">
				<div class="col-md-10">
					<input type="date" name="filtertanggal" class="form-control">
				</div>
				<div class="col-md-1" style="margin-left: -10px">
					<button class="btn btn-success">cari</button>
				</div>
				</form>
			</div>
			
			
		</div>
		<div class="col-md-4" style="border-right: 3px solid #1c7bd9;">
			<label>Pendapatan perbulan</label>
			<div class="row">
				<form id="my_form" method="GET" action="{{url('/filterbulan')}}" enctype="multipart/form-data">
				<div class="col-md-5">
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
				<div class="col-md-5" style="margin-left: -10px">
				<select name="filtertahun" class="form-control" id="exampleFormControlSelect1">
			      <option>-- Pilih tahun --</option>
			      @for ($i=date('Y'); $i >= 2017 ; $i--)
			      <option value="{{$i}}">{{$i}}</option>
			      @endfor
			    </select>
				</div>
				<div class="col-md-1" style="margin-left: -10px">
					<button class="btn btn-success">cari</button>
				</div>
				</form>
			</div>
		</div>
		<div class="col-md-4" >
			<label>Pendapatan pertahun</label>
			<div class="row">
				<form id="my_form" method="GET" name="filtertahun" action="{{url('/filtertahun')}}" enctype="multipart/form-data">
				<div class="col-md-10">
					<select name="filtertahun" class="form-control" id="exampleFormControlSelect1">
				      <option>-- Pilih tahun --</option>
				      @for ($i=date('Y'); $i >= 2017 ; $i--)
				      <option>{{$i}}</option>
				      @endfor
				    </select>
				</div>
				<div class="col-md-1" style="margin-left: -10px">
					<button class="btn btn-success">cari</button>
				</div>
				</form>
			</div>
			
		</div>
	</div>
	<br>
	@if($status=="tanggal")
	<h3>Data Pendapatan {{Carbon\Carbon::parse($tanggal_laporan)->formatLocalized('%A, %d %B %Y')}}</h3>
	@elseif($status=="bulan")
	<h3>Data Pendapatan {{Carbon\Carbon::parse($tanggal_laporan)->formatLocalized('%B %Y')}}</h3>
	@elseif($status=="filterbulan")
	<h3>Data Pendapatan {{$laporan_bulanan}} {{$filter_tahun}}</h3>
	@elseif($status=="filtertahun")
	<h3>Data Pendapatan {{$filter_tahun}}</h3>
	@endif
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border" style="text-align: center">
			<h3 class="box-title"><b>Daftar Pendapatan</b></h3>
		</div>
		<div class="box-body" style="border-bottom: 1px solid #00c0ef; ">
			<div class="table-responsive">
				<table id="laporan" class="table table-bordered table-striped" style="text-align: center">
					<thead >
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Tanggal Laundry</th>
							<th style="text-align: center;">Nama Pelanggan</th>
							<th style="text-align: center;">Telepon</th>	
							<th style="text-align: center;">Nota</th>
							<th style="text-align: center;">Total Laundry</th>
						</tr>
					</thead>
					<tbody>
						@foreach($rekaps as $index => $rekap)
						<tr>
							<td>{{$index+1}}</td>
							<td>{{$rekap->tanggal_masuk}}</td>
							<td>{{$rekap->pelanggan->nama_pelanggan}}</td>
							<td>{{$rekap->pelanggan->no_telp}}</td>
							<td>
				              <a href="{{url('/invoice/'. $rekap->id)}}"><i class="fas fa-file" style="font-size: 20px"></i></a>
				            </td>
				            <td>{{$rekap->total}}</td>
						</tr>
						@endforeach
 					</tbody>
 					<tfoot>
 						<tr>
 							<td colspan="5">
 								<b>Pendapatan</b>	
 							</td>
 							<td>
 								<b>{{$pendapatan}}</b>
 							</td>
 						</tr>
 						
 					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('#laporan').DataTable()
</script>
@endsection