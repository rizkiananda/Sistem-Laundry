<link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/table-border.css')}}">
<link rel="stylesheet" href="{{URL::asset('bootstrap/css/bootstrap.css')}}">   
<link rel="stylesheet" href="{{URL::asset('dist/css/AdminLTE.css')}}">
<link rel="stylesheet" href="{{URL::asset('dist/css/skins/_all-skins.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('fontawesome5/css/all.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('fontawesome5/webfonts/fontawesome-all.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('fontawesome5/fonts/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('bower_components/Ionicons/css/ionicons.min.css')}}">
<body onload="window.print();">
	<div class="container">
		<center>
			<font face="Brush Script Mt" size="7">Nama Laundry</font><br>
			<font face="Comic Sans MS" size="3">Alamat laundry</font><br>	
			<font face="Comic Sans MS" size="3">Telp Laundry</font>
		</center>
		<hr style="border: 3px solid black">
		<hr style="border: 1px solid black; margin-top: -9px">
		{{-- pc --}}
		<div class="row hidden-xs">
			<div class="col-md-6 col-sm-6" style="font-family: Century">
				<span class="col-md-3 col-sm-5">Pelanggan</span> <span class="col-md-9 col-sm-7">: {{$data_pembayaran->pelanggan->nama_pelanggan}}</span>
				<span class="col-md-3 col-sm-5">Alamat</span> <span class="col-md-9 col-sm-7">: {{$data_pembayaran->pelanggan->alamat}}</span>
				<span class="col-md-3 col-sm-5">Telepon</span>	<span class="col-md-9 col-sm-7">: {{$data_pembayaran->pelanggan->no_telp}}</span>
			</div>
			<div class="col-md-6 col-sm-6" style="font-family: Century">
				<span class="col-md-3 col-sm-5">No Transaksi</span> <span class="col-md-9 col-sm-7">: #{{$data_pembayaran->id_rekap}}</span>
				<span class="col-md-3 col-sm-5">Tanggal masuk</span> <span class="col-md-9 col-sm-7">: {{Carbon\Carbon::parse($data_pembayaran->tanggal_masuk)->format('d-m-Y')}}</span>
				{{-- <span class="col-md-3 col-sm-5">Tanggal selesai</span> <span class="col-md-9 col-sm-7">: 25 September 2018</span> --}}
			</div>
		</div>
		{{-- mobile --}}
		<div class="row visible-xs" style="font-family: Century">
			<span class="col-xs-5">Pelanggan</span> <span class="col-sm-7 col-xs-7">: {{$data_pembayaran->pelanggan->nama_pelanggan}}</span>
			<span class="col-xs-5">Alamat</span> <span class="col-xs-7">: {{$data_pembayaran->pelanggan->alamat}}</span>
			<span class="col-xs-5">Telepon</span>	<span class="col-xs-7">: {{$data_pembayaran->pelanggan->no_telp}}</span>					
			<span class="col-xs-5">No Transaksi</span> <span class="col-xs-7">: #{{$data_pembayaran->id_rekap}}</span>
			<span class="col-xs-5">Tgl masuk</span> <span class="col-xs-7">:  {{Carbon\Carbon::parse($data_pembayaran->tanggal_masuk)->format('d-m-Y')}}</span>
			{{-- <span class="col-xs-5">Tgl selesai</span> <span class="col-xs-7">: 25 September 2018</span> --}}
		</div>
		<br>
		<div class="table-responsive">
		<table class="table table-bordereds table-striped" style="font-family: Century; font-size: 12px">
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
		<div class="row" style="font-family: Century">
			<div class="col-md-6 col-sm-6">
				<span class="col-md-3 col-xs-5">Total</span> <span class="col-md-9 col-xs-7"> : Rp {{$transaksi->rekap->total}}</span>
				<span class="col-md-3 col-xs-5">Dibayar/DP</span> <span class="col-md-9 col-xs-7">: Rp {{$transaksi->rekap->bayar}}</span>
			</div>
			<div class="col-md-6 col-sm-6">
					
					<span class="col-md-3 col-xs-5">Sisa</span> <span class="col-md-9 col-xs-7"> : Rp {{$sisa}}</span>
					<span class="col-md-3 col-xs-5">Kembali</span> <span class="col-md-9 col-xs-7">: Rp {{$kembali}}</span>
				<br><br><br><br><br><br>
				<div style="text-align: center">
					<p>Hormat Kami</p>
					<br>
					<p>Nama Laundry</p>
					<h3 style="font-family: Mistral">Terimakasih atas kepercayaan anda</h3>
				</div>
				
			</div>
			
		</div>
	</div>
</body>