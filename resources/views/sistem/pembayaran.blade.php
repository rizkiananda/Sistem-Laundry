@extends('layout.sistem')
@section('title', 'Laundry - transaksi')

@section('content')
<div class="container">
	<h3>Pembayaran</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>
	<div class="panel panel-default">
		<div class="panel-body">
			<center>
				<h3>Nama Laundry</h3>
				<h5>Alamat laundry</h5>	
				<h5>Telp laundry</h5>
			</center>
			<hr style="border: 3px solid black">
			<hr style="border: 1px solid black; margin-top: -9px">
			{{-- pc --}}
			<div class="row hidden-xs">
				<div class="col-md-6 col-sm-6">
					<span class="col-md-3 col-sm-5">Pelanggan</span> <span class="col-md-9 col-sm-7">: {{$data_pembayaran->pelanggan->nama_pelanggan}}</span>
					<span class="col-md-3 col-sm-5">Alamat</span> <span class="col-md-9 col-sm-7">: {{$data_pembayaran->pelanggan->alamat}}</span>
					<span class="col-md-3 col-sm-5">Telepon</span>	<span class="col-md-9 col-sm-7">: {{$data_pembayaran->pelanggan->no_telp}}</span>
				</div>
				<div class="col-md-6 col-sm-6">
					<span class="col-md-3 col-sm-5">No Transaksi</span> <span class="col-md-9 col-sm-7">: #{{$data_pembayaran->id_rekap}}</span>
					<span class="col-md-3 col-sm-5">Tanggal masuk</span> <span class="col-md-9 col-sm-7">: {{Carbon\Carbon::parse($data_pembayaran->tanggal_masuk)->format('d-m-Y')}}</span>
					{{-- <span class="col-md-3 col-sm-5">Tanggal selesai</span> <span class="col-md-9 col-sm-7">: 25 September 2018</span>
 --}}				</div>
			</div>
			{{-- mobile --}}
			<div class="row visible-xs">
				<span class="col-xs-5">Pelanggan</span> <span class="col-sm-7 col-xs-7">: {{$data_pembayaran->pelanggan->nama_pelanggan}}</span>
				<span class="col-xs-5">Alamat</span> <span class="col-xs-7">: {{$data_pembayaran->pelanggan->alamat}}</span>
				<span class="col-xs-5">Telepon</span>	<span class="col-xs-7">: {{$data_pembayaran->pelanggan->no_telp}}</span>					
				<span class="col-xs-5">No Transaksi</span> <span class="col-xs-7">: #{{$data_pembayaran->id_rekap}}</span>
				<span class="col-xs-5">Tgl masuk</span> <span class="col-xs-7">: {{Carbon\Carbon::parse($data_pembayaran->tanggal_masuk)->format('d-m-Y')}}</span>
				{{-- <span class="col-xs-5">Tgl selesai</span> <span class="col-xs-7">: 25 September 2018</span> --}}
			</div>
			<br>
			<div class="table-responsive">
			<table class="table table-bordered table-striped">
				  <thead>
				    <tr>
				      <th style="text-align: center;">No</th>
				      <th style="text-align: center;">Pakaian</th>
				      <th style="text-align: center;">Layanan</th>
				      <th style="text-align: center;">Paket</th>
				      <th style="text-align: center;">Jumlah</th>
				      <th style="text-align: center;">Berat/kg</th>
				      <th style="text-align: center;">Harga</th>
				      <th style="text-align: center;">Subtotal</th>
				      <th style="text-align: center;">Tanggal Selesai</th>
				    </tr>
				  </thead>
				  <tbody style="text-align: center">
				    @foreach($transaksis as $index => $transaksi)
				    <tr>
				      <td>{{$index+1}}</td>
				      @if($transaksi->harga->jenis_pakaian==null)
				      <td>-</td>
				      @else
				      <td>{{$transaksi->harga->jenis_pakaian->nama_pakaian}}</td>
				      @endif
				      <td>{{$transaksi->harga->jenis_layanan->nama_layanan}}</td>
				      <td>{{$transaksi->harga->jenis_paket->nama_paket}}</td>
				      <td>{{$transaksi->jumlah}}</td>
				      @if($transaksi->berat!=null)
				      <td>{{$transaksi->berat}}</td>
				      @else
				      <td>-</td>
				      @endif
				      <td>{{$transaksi->harga->harga}}</td>
				      <td>{{$transaksi->subtotal}}</td>
				      <td>{{Carbon\Carbon::parse($transaksi->tanggal_selesai)->format('d-m-Y')}}</td>
				    </tr>
				    @endforeach
				  </tbody>
			</table>
			</div>
			<div class="row">
				<form method="POST" action="{{url('/bayar')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_pembayaran" id="id_pembayaran" value="{{$transaksi->id_rekap}}" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
		              	<label>Uang yang dibayarkan</label>
		              	<div class="input-group">
		              		<div class="input-group-addon">
		              			<span>Rp</span>
		              		</div>
		              		<input id="bayar" type="text" oninput="counting()" class="form-control readonly" name="bayar" style="width: 50%">
		              	</div>
	              	</div>
				</div>
				<div class="col-md-6 col-sm-6">
						<span class="col-md-3 col-xs-5">Total</span> <span class="col-md-9 col-xs-7"> : Rp <input id="total" type="text" name="" style="border:none;" value="{{$transaksi->rekap->total}}" readonly></span>
						@if($transaksi->rekap->bayar!=null)
						<span class="col-md-3 col-xs-5">Dibayar/DP</span> <span class="col-md-9 col-xs-7">: Rp <input type="text" id="dibayar" name="" style="border:none;" value="{{$transaksi->rekap->bayar}}"> </span>
						@else
						<span class="col-md-3 col-xs-5">Dibayar/DP</span> <span class="col-md-9 col-xs-7">: Rp <input type="text" id="dibayar" name="" style="border:none;" value="0"> </span>
						@endif
						<span class="col-md-3 col-xs-5">Sisa</span> <span class="col-md-9 col-xs-7"> : Rp <input id="sisa" type="text" name="" style="border:none;" value="{{$sisa}}"></span>
						<span class="col-md-3 col-xs-5">Kembali</span> <span class="col-md-9 col-xs-7">: Rp <input type="text" id="kembali" style="border:none;" name="" value="{{$kembali}}"></span>

					<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Simpan Pembayaran</button>
					</form>
					
					
				</div>
				
			</div>
		</div>

	</div>	
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{URL::asset('/js/jquery.printPage.js')}}"></script>
{{-- <script type="text/javascript">
	$(document).ready(function(){
		$('.btn-default').printPage();
	})
</script>
 --}}
<script type="text/javascript">
	@if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif

  	if(document.getElementById("sisa").value == 0){
		document.getElementById("bayar").setAttribute("disabled", "disabled");
  	}

  	function counting(){
  		if(document.getElementById("bayar").value==""){
  			document.getElementById("kembali").value = 0
  		}
  		if(document.getElementById("dibayar").value==0){
  			document.getElementById("kembali").value = document.getElementById("bayar").value-document.getElementById("total").value
  		}
  		else{
  			document.getElementById("kembali").value = document.getElementById("bayar").value-document.getElementById("sisa").value
  		}
  		
  		
  		if(document.getElementById("kembali").value < 0){
  			document.getElementById("kembali").value = 0
  		}
  	}
</script>
 	

@endsection