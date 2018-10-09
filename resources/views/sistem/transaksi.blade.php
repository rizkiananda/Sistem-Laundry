@extends('layout.sistem')
@section('title', 'Laundry - transaksi')
@section('styles')
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.css')}}">
@endsection

@section('content')
<div class="container">
	<h3>Transaksi</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>
		{{-- pelanggan & tgl masuk --}}
		<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
            <div class="box-header with-border">
	              <h3 class="box-title">Pelanggan dan tanggal masuk</h3>
	        </div>
	        <div class="box-body with-border">
	        	<form method="POST" action="{{url('/rekaptransaksi')}}" enctype="multipart/form-data">
				
	          	<div class="row">
	          		<div class="col-md-6">
	          			<div class="form-group">
			                <label>Pelanggan</label>
			                <select class="form-control select2" name="pelanggan">
			                  @foreach($pelanggans as $pelanggan)
			                  <option value="{{$pelanggan->id}}">{{$pelanggan->nama_pelanggan}} - {{$pelanggan->no_telp}}</option>
			                  @endforeach
			                </select>
			              </div>
			              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahpelanggan"><i class="fas fa-plus"></i>  Tambah Pelanggan</button>
			              <br><br>
	          		</div>
	          		<div class="col-md-6">
	          			<div class="form-group">
		                  	<label for="exampleInputEmail1">Tanggal masuk</label>
		                  	<div class="input-group">
			                  	<div class="input-group-addon">
			                    	<i class="fa fa-calendar"></i>
			                  	</div>
		                  	  	<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="tgl_masuk" required>
		                  	</div>
		                </div>
		                
	          		</div>
	          	</div>
	          	<br>
	          	<center>

	          	{{-- pc --}}
              	<button type="button" class="btn btn-primary hidden-xs" data-toggle="modal" data-target="#laundrykiloan">
              		<h4><i class="fas fa-balance-scale" style="font-size: 30px; margin-bottom: 5px"></i>
              		<br>
              		Laundry Kiloan</h4>
              	</button>
              	<button type="button" class="btn btn-primary hidden-xs" data-toggle="modal" data-target="#laundrysatuan">
              		<h4><i class="fas fa-tshirt" style="font-size: 30px; margin-bottom: 5px"></i>
              		<br>
              		Laundry Satuan</h4>
              	</button>
              	</center>

              	{{-- mobile --}}
              	<div class="row">
	              	<div class="col-xs-6">
		              	<a href="#" class="btn btn-primary visible-xs" data-toggle="modal" data-target="#laundrykiloan">
		              		<i class="fas fa-balance-scale"></i>
		              		<br>
		              		Kiloan
		              	</a>
		              	</div>
		              	<div class="col-xs-6">
		              	<a href="#" class="btn btn-primary visible-xs" data-toggle="modal" data-target="#laundrysatuan">
		              		<i class="fas fa-tshirt"></i>
		              		<br>
		              		Satuan
		              	</a>
	              	</div>
              	</div>
	        </div>
	        
	    </div>

		{{-- list orderan --}}
		<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
            <div class="box-header with-border">
	              <h3 class="box-title">Daftar Transaksi</h3>
	              <a href="{{url('/transaksi_edit')}}" class="btn btn-warning"><i class="fas fa-cogs"></i> Pengaturan</a>
	        </div>

	        <div class="box-body with-border">
	        	<div class="table-responsive">
	        	<table class="table table-bordered table-striped">
				  <thead>
				    <tr style="text-align: center;">
				      <th>No</th>
				      <th>Pakaian</th>
				      <th>Layanan</th>
				      <th>Paket</th>
				      <th>Tanggal Selesai</th>
				      <th>Jumlah</th>
				      <th>Berat/kg</th>
				      <th>Harga</th>
				      <th>Total</th>
				      {{-- <th></th> --}}
				    </tr>
				  </thead>
				  <tbody style="text-align: center">
				    @foreach($keranjangs as $index => $keranjang)
				    <tr>
				      <td>{{$index+1}}</td>
				      @if($keranjang->harga->id_jenis_pakaian==null)
				      <td>- <input type="text" name="jenis_pakaian[]" value="" hidden></td>
				      @else
				      <td>{{$keranjang->harga->jenis_pakaian->nama_pakaian}} <input type="text" name="jenis_pakaian[]" value="{{$keranjang->harga->jenis_pakaian->nama_pakaian}}" hidden></td>
				      @endif
				      <td>{{$keranjang->harga->jenis_layanan->nama_layanan}} <input type="text" name="jenis_layanan[]" value="{{$keranjang->harga->jenis_layanan->nama_layanan}}" hidden></td>
				      <td>{{$keranjang->harga->jenis_paket->nama_paket}} <input type="text" name="jenis_paket[]" value="{{$keranjang->harga->jenis_paket->nama_paket}}" hidden></td>
				      <td>{{$keranjang->tanggal_selesai}} <input type="text" name="tgl_selesai[]" value="{{$keranjang->tanggal_selesai}}" hidden></td>
				      <td>{{$keranjang->jumlah}} <input type="text" name="jumlah[]" value="{{$keranjang->jumlah}}" hidden></td>
				      @if($keranjang->berat!=null)
				      <td>{{$keranjang->berat}} <input type="text" name="berat[]" value="{{$keranjang->berat}}" hidden></td>
				      @else
				      <td>- <input type="text" name="berat[]" value="" hidden></td>
				      @endif
				      <td>{{$keranjang->harga->harga}} <input type="text" name="harga[]" value="{{$keranjang->harga->id}}" hidden></td>				      
					  <td>{{$keranjang->subtotal}} <input type="text" name="subtotal[]" value="{{$keranjang->subtotal}}" hidden></td>
				     {{--  <td>
				      	<form method="POST" action="{{url('/hapustransaksi/'.$keranjang->id)}}" enctype="multipart/form-data">
				      	<button class="btn btn-warning" data-toggle="modal" data-target="#edittransaksi" data-id="{{$keranjang->id}}" type="button"><i class="fa fa-edit"></i> Edit</button>
				      	 <input type="hidden" name="_method" value="DELETE"/>
				      	<button class="btn btn-danger" id="deletetransaksi" type="submit" data-id="{{$keranjang->id}}"><i class="fas fa-trash-alt"></i> Hapus</button>
				      	{{csrf_field()}}
				        </form>
				      </td> --}}
				    </tr>
				    @endforeach
				    <tr>
				      <td colspan="8" style="text-align: right;">Total yang harus dibayar</td>
				      <td>{{$total}} <input type="text" name="total" value="{{$total}}" hidden></td>
				    </tr>
				  </tbody>
				</table>
				</div>
				<br>
				<button class="btn btn-success pull-right"><i class="fas fa-arrow-right"></i> lanjut ke pembayaran</button>
				{{csrf_field()}}
				</form>
	        </div>
	    </div>

</div>

<!-- Modal tambah laundry kiloan-->
<div class="modal fade" id="laundrykiloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Laundry Kiloan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/keranjangkiloan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
	                <label>Jenis Layanan</label>
	                <select class="form-control" id="jenis_layanan" name="jenis_layanan" onchange="clearharga()">
	                  <option value="null">-- Pilih jenis layanan --</option>
				      @foreach($layanan_kiloans as $layanan_kiloan)
				      <option value="{{$layanan_kiloan->id}}">{{$layanan_kiloan->nama_layanan}}</option>
				      @endforeach
	                </select>
	            </div>
	            <div class="form-group">
	                <label>Jenis Paket</label>
	                <select class="form-control" id="jenis_paket" name="jenis_paket" onchange="clearharga()">
	                   	@foreach($jenis_pakets as $jenis_paket)
					      <option value="null">-- Pilih jenis paket --</option>
					      <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama_paket}}</option>
					    @endforeach
	                </select>
	            </div>
	             <div class="row">
		            <div class="col-md-6 col-sm-8 col-xs-7">
		               	<div class="form-group">
			              	<label>Harga</label>
			              	<div class="input-group">
			              		<div class="input-group-addon">
			              			<span>Rp</span>
			              		</div>
			              		<input type="text" id="harga" class="form-control readonly" name="harga" required>
			              		<input type="text" id="id_harga" name="id_harga" hidden>
			              	</div>
		              	</div>
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-4">
		            	<div class="form-group">
			            	<label style="color: white">Harga</label>
			            	<a class="btn btn-primary" onclick="cekhargakiloan()">Cek Harga</a>
		            	</div>
		            </div>
		        </div>
	            <div class="row">
		            <div class="col-md-4 col-sm-12 col-xs-12">
			            <div class="form-group">
			              	<label>Jumlah pakaian</label>
			              	<div class="input-group">
			              		<input type="text" class="form-control" name="jumlah_pakaian" required>
			              		<div class="input-group-addon">
			              			<span>pcs</span>
			              		</div>
			              	</div>
			            </div>
		            </div>
	            </div>
	            <div class="row">
		            <div class="col-md-4 col-sm-12 col-xs-12">
			            <div class="form-group">
			              	<label>Berat</label>
			              	<div class="input-group">
			              		<input type="text" class="form-control" name="berat" required>
			              		<div class="input-group-addon">
			              			<span>kg</span>
			              		</div>
			              	</div>
			            </div>
			        </div>
	            </div>
	           
		        <div class="form-group">
                  	<label for="exampleInputEmail1">Tanggal selesai</label>
                  	<div class="input-group">
	                  	<div class="input-group-addon">
	                    	<i class="fa fa-calendar"></i>
	                  	</div>
                  	  	<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="tgl_selesai" required>
                  	</div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button id="simpan" type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal tambah laundry satuan-->
<div class="modal fade" id="laundrysatuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Laundry Satuan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/keranjangsatuan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
        		<div class="form-group">
	                <label>Jenis Pakaian</label>
	                <select class="form-control" id="jenis_pakaian" name="jenis_pakaian" onchange="clearharga2()">
	                  <option value="null">-- Pilih jenis pakaian --</option>
				      @foreach($jenis_pakaians as $jenis_pakaian)
				      <option value="{{$jenis_pakaian->id}}">{{$jenis_pakaian->nama_pakaian}}</option>
				      @endforeach
	                </select>
	            </div>	
      			<div class="form-group">
	                <label>Jenis Layanan</label>
	                <select class="form-control" id="jenis_layanan2" name="jenis_layanan" onchange="clearharga2()">
	                  <option value="null">-- Pilih jenis layanan --</option>
				      @foreach($layanan_satuans as $layanan_satuan)
				      <option value="{{$layanan_satuan->id}}">{{$layanan_satuan->nama_layanan}}</option>
				      @endforeach
	                </select>
	            </div>
	            <div class="form-group">
	                <label>Jenis Paket</label>
	                <select class="form-control" id="jenis_paket2" name="jenis_paket" onchange="clearharga2()">
	                   	@foreach($jenis_pakets as $jenis_paket)
					      <option value="null">-- Pilih jenis paket --</option>
					      <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama_paket}}</option>
					    @endforeach
	                </select>
	            </div>
	            <div class="row">
		            <div class="col-md-6 col-sm-12 col-xs-12">
		               	<div class="form-group">
			              	<label>Harga</label>
			              	<div class="input-group">
			              		<div class="input-group-addon">
			              			<span>Rp</span>
			              		</div>
			              		<input type="text" id="harga2" class="form-control readonly" name="harga" required>
			              		<input type="text" id="id_harga2" name="id_harga" hidden>
			              	</div>
		              	</div>
		            </div>
		            <div class="col-md-2">
		            	<div class="form-group">
			            	<label style="color: white">Harga</label>
			            	<a class="btn btn-primary" onclick="cekhargasatuan()">Cek Harga</a>
		            	</div>
		            </div>
		        </div>
	            <div class="row">
		            <div class="col-md-4 col-sm-12 col-xs-12">
			            <div class="form-group">
			              	<label>Jumlah pakaian</label>
			              	<div class="input-group">
			              		<input type="text" class="form-control" name="jumlah_pakaian">
			              		<div class="input-group-addon">
			              			<span>pcs</span>
			              		</div>
			              	</div>
			            </div>
		            </div>
	            </div>
	            
		        <div class="form-group">
                  	<label for="exampleInputEmail1">Tanggal selesai</label>
                  	<div class="input-group">
	                  	<div class="input-group-addon">
	                    	<i class="fa fa-calendar"></i>
	                  	</div>
                  	  	<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="tgl_selesai">
                  	</div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button id="simpan" type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah pelanggan-->
<div class="modal fade" id="tambahpelanggan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Pelanggan Baru</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahpelanggan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Pelanggan</label>
					<input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">No telpon</label>
					<input type="text" class="form-control" id="telepon" name="telepon" required>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Alamat</label>
					<input type="text" class="form-control" id="alamat" name="alamat" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button id="simpan" type="submit2" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
    $('.select2').select2()

    @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif


</script>

<script type="text/javascript">
  	function cekhargakiloan(){
   	var jenis_layanan = document.getElementById("jenis_layanan").value;
   	var jenis_paket = document.getElementById("jenis_paket").value;
    var CSRF_TOKEN = '{{csrf_token()}}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':CSRF_TOKEN
        }
    });
    $.ajax({
        url:'/cekhargakiloan',
        type:'POST',
        data:{jenis_layanan:jenis_layanan,jenis_paket:jenis_paket,_token:CSRF_TOKEN},
        success : function(data){
        	console.log("data: ");
           	console.log(data);
           	$('#harga').val(data.harga)
            $('#id_harga').val(data.id)
        }
    });
  	}

	function cekhargasatuan(){
  	var jenis_pakaian = document.getElementById("jenis_pakaian").value;	
   	var jenis_layanan = document.getElementById("jenis_layanan2").value;
   	var jenis_paket = document.getElementById("jenis_paket2").value;
    var CSRF_TOKEN = '{{csrf_token()}}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':CSRF_TOKEN
        }
    });
    $.ajax({
        url:'/cekhargasatuan',
        type:'POST',
        data:{jenis_pakaian:jenis_pakaian,jenis_layanan:jenis_layanan,jenis_paket:jenis_paket,_token:CSRF_TOKEN},
        success : function(data){
    	console.log("data: ");
       	console.log(data);
       	$('#harga2').val(data.harga)
        $('#id_harga2').val(data.id)
        }
    });
  	}

  	

  	$(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });

  	function clearharga(){
  		$('#harga').val("")
        $('#id_harga').val("")
  	}
  	function clearharga2(){
  		$('#harga2').val("")
        $('#id_harga2').val("")
  	}

</script>

@endsection