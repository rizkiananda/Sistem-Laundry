@extends('layout.sistem')
@section('title', 'Laundry - transaksi')
@section('styles')
<link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.css')}}">
@endsection

@section('content')
<div class="container">
	<h3>Pengaturan Transaksi</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>

	{{-- list orderan --}}
		<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
            <div class="box-header with-border">
	              <h3 class="box-title">Daftar Transaksi</h3>
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
				      <th></th>
				    </tr>
				  </thead>
				  <tbody style="text-align: center">
				    @foreach($keranjangs as $index => $keranjang)
				    <tr>
				      <td>{{$index+1}}</td>
				      @if($keranjang->harga->id_jenis_pakaian==null)
				      <td>-</td>
				      @else
				      <td>{{$keranjang->harga->jenis_pakaian->nama_pakaian}}</td>
				      @endif
				      <td>{{$keranjang->harga->jenis_layanan->nama_layanan}}</td>
				      <td>{{$keranjang->harga->jenis_paket->nama_paket}} </td>
				      <td>{{$keranjang->tanggal_selesai}} </td>
				      <td>{{$keranjang->jumlah}} </td>
				      @if($keranjang->berat!=null)
				      <td>{{$keranjang->berat}}</td>
				      @else
				      <td>-</td>
				      @endif
				      <td>{{$keranjang->harga->harga}} </td>				      
					  <td>{{$keranjang->subtotal}}</td>
				      <td>
				      	<form method="POST" action="{{url('/hapustransaksi/'.$keranjang->id)}}" enctype="multipart/form-data">
				      	<button class="btn btn-warning" data-toggle="modal" data-target="#edittransaksi" data-id="{{$keranjang->id}}" type="button"><i class="fa fa-edit"></i> Edit</button>
				      	 <input type="hidden" name="_method" value="DELETE"/>
				      	<button class="btn btn-danger" id="deletetransaksi" type="submit" data-id="{{$keranjang->id}}"><i class="fas fa-trash-alt"></i> Hapus</button>
				      	{{csrf_field()}}
				        </form>
				      </td>
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
				<a href="{{url('/transaksi')}}" class="btn btn-success pull-right"><i class="fas fa-arrow-left"></i> kembali ke transaksi</a>
	        </div>
	    </div>
</div>

<!-- Modal edit laundry-->
<div class="modal fade" id="edittransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Laundry Kiloan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/edittransaksi')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_keranjang" id="id_keranjang" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				{{-- edit jenis pakaian --}}
				<div class="form-group" id="edit_pakaian">
	                <label>Jenis Pakaian</label>
	                <select class="form-control" id="jenis_pakaian" name="jenis_pakaian" onchange="clearharga4()">
	                  <option value="null">-- Pilih jenis pakaian --</option>
				      @foreach($jenis_pakaians as $jenis_pakaian)
				      <option value="{{$jenis_pakaian->id}}">{{$jenis_pakaian->nama_pakaian}}</option>
				      @endforeach
	                </select>
	            </div>
	            {{-- edit layanan kiloan	 --}}
				<div class="form-group" id="edit_layanan_kiloan">
	                <label>Jenis Layanan</label>
	                <select class="form-control" id="layanankiloan_edit" name="jenis_layanan" onchange="clearharga3()">
				       <option value="null">-- Pilih jenis layanan --</option>
				      @foreach($layanan_kiloans as $layanan_kiloan)
				      <option value="{{$layanan_kiloan->id}}">{{$layanan_kiloan->nama_layanan}}</option>
				      @endforeach
	                </select>
	            </div>
	            {{-- edit layanan satuan --}}
	            <div class="form-group" id="edit_layanan_satuan">
	                <label>Jenis Layanan</label>
	                <select class="form-control" id="layanan_satuan" name="jenis_layanan" onchange="clearharga4()">
	                  <option value="null">-- Pilih jenis layanan --</option>
				      @foreach($layanan_satuans as $layanan_satuan)
				      <option value="{{$layanan_satuan->id}}">{{$layanan_satuan->nama_layanan}}</option>
				      @endforeach
	                </select>
	            </div>
	            {{-- edit paket kiloan --}}
	            <div class="form-group" id="edit_paket_kiloan">
	                <label>Jenis Paket</label>
	                <select class="form-control" id="paketkiloan_edit" name="jenis_paket" onchange="clearharga3()">
	                   	<option value="null">-- Pilih jenis paket --</option>
	                   	@foreach($jenis_pakets as $jenis_paket)
					      <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama_paket}}</option>
					    @endforeach
	                </select>
	            </div>
	            {{-- edit paket satuan --}}
	            <div class="form-group" id="edit_paket_satuan">
	                <label>Jenis Paket</label>
	                <select class="form-control" id="paket_satuan" name="jenis_paket" onchange="clearharga4()">
	                   	<option value="null">-- Pilih jenis paket --</option>
	                   	@foreach($jenis_pakets as $jenis_paket)
					      <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama_paket}}</option>
					    @endforeach
	                </select>
	            </div>
	            {{-- harga kiloan --}}
	            <div class="row" id="harga_kiloan_edit">
		            <div class="col-md-6 col-sm-8 col-xs-7">
		               	<div class="form-group">
			              	<label>Harga</label>
			              	<div class="input-group">
			              		<div class="input-group-addon">
			              			<span>Rp</span>
			              		</div>
			              		<input type="text" id="hargakiloan_edit" class="form-control readonly" name="harga">
			              		<input type="text" id="id_hargakiloan_edit" name="id_hargakiloan" hidden>
			              	</div>
		              	</div>
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-4">
		            	<div class="form-group">
			            	<label style="color: white">Harga</label>
			            	<a id="cekhargakiloan" class="btn btn-primary">Cek Harga</a>
		            	</div>
		            </div>
		        </div>
		        {{-- harga satuan --}}
		        <div class="row" id="harga_satuan_edit">
		            <div class="col-md-6 col-sm-8 col-xs-7">
		               	<div class="form-group">
			              	<label>Harga</label>
			              	<div class="input-group">
			              		<div class="input-group-addon">
			              			<span>Rp</span>
			              		</div>
			              		<input type="text" id="harga_satuan" class="form-control readonly" name="harga">
			              		<input type="text" id="id_hargasatuan" name="id_hargasatuan" hidden>
			              	</div>
		              	</div>
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-4">
		            	<div class="form-group">
			            	<label style="color: white">Harga</label>
			            	<a id="cekhargasatuan" class="btn btn-primary">Cek Harga</a>
		            	</div>
		            </div>
		        </div>

	            <div class="row">
		            <div class="col-md-4 col-sm-12 col-xs-12">
			            <div class="form-group">
			              	<label>Jumlah pakaian</label>
			              	<div class="input-group">
			              		<input type="text" id="jumlah_pakaian_edit" class="form-control" name="jumlah_pakaian" required>
			              		<div class="input-group-addon">
			              			<span>pcs</span>
			              		</div>
			              	</div>
			            </div>
		            </div>
	            </div>
	            <div class="row">
		            <div class="col-md-4 col-sm-12 col-xs-12">
			            <div class="form-group" id="edit_berat">
			              	<label>Berat</label>
			              	<div class="input-group">
			              		<input type="text" id="berat_edit" class="form-control" name="berat">
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
                  	  	<input type="date" class="form-control" id="tgl_selesai_edit" placeholder="Enter email" name="tgl_selesai" required>
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
@endsection

@section('script')
<script type="text/javascript">
	 @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif


	function cekhargakiloan_edit(){
   	var jenis_layanan = document.getElementById("layanankiloan_edit").value;
   	var jenis_paket = document.getElementById("paketkiloan_edit").value;
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
           	$('#hargakiloan_edit').val(data.harga)
            $('#id_hargakiloan_edit').val(data.id)
        }
    });
  	}

  	function cekhargasatuan_edit(){
  	var jenis_pakaian = document.getElementById("jenis_pakaian").value;	
   	var jenis_layanan = document.getElementById("layanan_satuan").value;
   	var jenis_paket = document.getElementById("paket_satuan").value;
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
       	$('#harga_satuan').val(data.harga)
        $('#id_hargasatuan').val(data.id)
        }
    });
  	}

  	$('#edittransaksi').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_keranjang').val(id);

        $.ajax({
          url : 'gettransaksi/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
       		if(data[1]=="kiloan"){
       			// modal.find('#jenis_pakaian').setAttribute("hidden", "hidden")
       			document.getElementById("edit_pakaian").setAttribute("hidden", "hidden");
       			document.getElementById("edit_layanan_satuan").setAttribute("hidden", "hidden");
       			document.getElementById("edit_layanan_kiloan").removeAttribute("hidden", "hidden");
       			document.getElementById("edit_paket_satuan").setAttribute("hidden", "hidden");
       			document.getElementById("edit_paket_kiloan").removeAttribute("hidden", "hidden");
       			document.getElementById("edit_berat").removeAttribute("hidden", "hidden");
       			document.getElementById("cekhargakiloan").setAttribute("onclick", "cekhargakiloan_edit()");
       			document.getElementById("harga_satuan_edit").setAttribute("hidden", "hidden");
       			document.getElementById("harga_kiloan_edit").removeAttribute("hidden", "hidden");
       			modal.find('#hargakiloan_edit').val(data[0].harga.harga)
       			modal.find('#jumlah_pakaian_edit').val(data[0].jumlah)
       			modal.find('#berat_edit').val(data[0].berat)
       			modal.find('#tgl_selesai_edit').val(data[0].tanggal_selesai)
       		}
       		else if(data[1]=="satuan"){
       			// modal.find('#berat').setAttribute("hidden", "hidden")
       			document.getElementById("edit_pakaian").removeAttribute("hidden", "hidden");
       			document.getElementById("edit_layanan_satuan").removeAttribute("hidden", "hidden");
       			document.getElementById("edit_layanan_kiloan").setAttribute("hidden", "hidden");
       			document.getElementById("edit_paket_satuan").removeAttribute("hidden", "hidden");
       			document.getElementById("edit_paket_kiloan").setAttribute("hidden", "hidden");
       			document.getElementById("edit_berat").setAttribute("hidden", "hidden");
       			document.getElementById("cekhargasatuan").setAttribute("onclick", "cekhargasatuan_edit()");
       			document.getElementById("harga_satuan_edit").removeAttribute("hidden", "hidden");
       			document.getElementById("harga_kiloan_edit").setAttribute("hidden", "hidden");
       			modal.find('#harga_satuan').val(data[0].harga.harga)
       			modal.find('#jumlah_pakaian_edit').val(data[0].jumlah)
       			modal.find('#tgl_selesai_edit').val(data[0].tanggal_selesai)
       		}

       		
       		// modal.find('#nama_layanan_terpilih').val(data[0].harga.id_jenis_layanan)
          },
        });
  	});

  	function clearharga3(){
		$('#hargakiloan_edit').val("")
		$('#id_hargakiloan_edit').val("")
  	}

  	function clearharga4(){
  		$('#harga_satuan').val("")
        $('#id_hargasatuan').val("")
  	}


  	$('button#deletetransaksi').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var nama = $(e.currentTarget).attr('data-name');
    var tabel = $(e.currentTarget).attr('data-table');
    swal({
      title: 'Hapus',
      text: "Apakah anda yakin akan menghapus transaksi ini ? ",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false
    },
    function (isConfirm) {
        if(isConfirm) form.submit();
    });
  });
</script>

@endsection
