@extends('layout.sistem')
@section('title', 'Laundry - daftar harga')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="container">
	<h3>Daftar harga</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>


	<button class="btn btn-success" data-toggle="modal" data-target="#hargakiloan"><i class="fas fa-plus"></i> Tambah harga</button>
		<br><br>
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border" style="text-align: center">
			<h3 class="box-title"><b>Daftar Harga Laundry Kiloan</b></h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="harga_kiloan" class="table table-bordered table-striped" style="text-align: center;">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Jenis Layanan</th>
							<th style="text-align: center;">Jenis Paket</th>
							<th style="text-align: center;">Harga</th>
							<th style="text-align: center;"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($hargas as $index => $harga)
							@if($harga->jenis_pakaian==null)
								<tr>
									<td>{{$index+1}}</td>
									<td>{{$harga->jenis_layanan->nama_layanan}}</td>
									<td>{{$harga->jenis_paket->nama_paket}}</td>
									<td>{{$harga->harga}}</td>
									<td>
									  <form method="POST" action="{{url('/hapusharga/'.$harga->id)}}" enctype="multipart/form-data">
						              <button class="btn btn-warning" data-toggle="modal" data-target="#edithargakiloan" data-id="{{$harga->id}}" type="button">Edit</button>
						              <input type="hidden" name="_method" value="DELETE"/>
						              <button class="btn btn-danger" id="deleteharga" type="submit" data-id="{{$harga->id}}">Hapus</button>
						              {{csrf_field()}}
				              		  </form>
						            </td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<button class="btn btn-success" data-toggle="modal" data-target="#hargasatuan"><i class="fas fa-plus"></i> Tambah harga</button>
		<br><br>
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border" style="text-align: center">
			<h3 class="box-title"><b>Daftar Harga Laundry Satuan</b></h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="harga_satuan" class="table table-bordered table-striped" style="text-align: center;">
					<thead>
						<tr >
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Jenis Pakaian</th>
							<th style="text-align: center;">Jenis Layanan</th>
							<th style="text-align: center;">Jenis Paket</th>
							<th style="text-align: center;">Harga</th>
							<th style="text-align: center;"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($hargas as $index => $harga)
							@if($harga->jenis_pakaian!=null)
								<tr>
									<td>{{$index+1}}</td>
									<td>{{$harga->jenis_pakaian->nama_pakaian}}</td>
									<td>{{$harga->jenis_layanan->nama_layanan}}</td>
									<td>{{$harga->jenis_paket->nama_paket}}</td>
									<td>{{$harga->harga}}</td>
									<td>
									  <form method="POST" action="{{url('/hapusharga/'.$harga->id)}}" enctype="multipart/form-data">
						              <button class="btn btn-warning" data-toggle="modal" data-target="#edithargasatuan" data-id="{{$harga->id}}" type="button">Edit</button>
						               <input type="hidden" name="_method" value="DELETE"/>
						              <button class="btn btn-danger" id="deleteharga" type="submit" data-id="{{$harga->id}}">Hapus</button>
						              {{csrf_field()}}
				              		  </form>
						            </td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah harga kiloan-->
<div class="modal fade" id="hargakiloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Harga Kiloan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahharga')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
				    <label for="exampleFormControlSelect1">Jenis Layanan</label>
				    <select name="jenis_layanan" class="form-control" id="exampleFormControlSelect1" required>
				      <option value="null">-- Pilih jenis layanan --</option>
				      @foreach($layanan_kiloans as $layanan_kiloan)
				      <option value="{{$layanan_kiloan->id}}">{{$layanan_kiloan->nama_layanan}}</option>
				      @endforeach
				    </select>
				</div>
				<div class="form-group">
				    <label for="exampleFormControlSelect1">Jenis Paket</label>
				    <select class="form-control" name="jenis_paket" id="exampleFormControlSelect1" required>
				      <option value="null">-- Pilih jenis paket --</option>
				      @foreach($jenis_pakets as $jenis_paket)
				      <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama_paket}}</option>
				      @endforeach
				    </select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="text" class="form-control" id="harga" name="harga" required>
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

<!-- Modal edit harga kiloan-->
<div class="modal fade" id="edithargakiloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Ubah Harga Kiloan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/editharga')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_harga" id="id_harga" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="text" class="form-control" id="harga" name="harga" required>
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

<!-- Modal tambah harga satuan-->
<div class="modal fade" id="hargasatuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Harga Satuan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahharga')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
				    <label for="exampleFormControlSelect1">Jenis Pakaian</label>
				    <select name="jenis_pakaian" class="form-control" id="exampleFormControlSelect1">
				      <option value="null">-- Pilih jenis pakaian --</option>
				      @foreach($jenis_pakaians as $jenis_pakaian)
				      <option value="{{$jenis_pakaian->id}}">{{$jenis_pakaian->nama_pakaian}}</option>
				      @endforeach
				    </select>
				</div>
				<div class="form-group">
				    <label for="exampleFormControlSelect1">Jenis Layanan</label>
				    <select name="jenis_layanan" class="form-control" id="exampleFormControlSelect1">
				      <option value="null">-- Pilih jenis layanan--</option>
				      @foreach($layanan_satuans as $layanan_satuan)
				      <option value="{{$layanan_satuan->id}}">{{$layanan_satuan->nama_layanan}}</option>
				      @endforeach
				    </select>
				</div>
				<div class="form-group">
				    <label for="exampleFormControlSelect1">Jenis Paket</label>
				    <select name="jenis_paket" class="form-control" id="exampleFormControlSelect1">
				      <option value="null">-- Pilih jenis paket--</option>
				      @foreach($jenis_pakets as $jenis_paket)
				      <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama_paket}}</option>
				      @endforeach
				    </select>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="text" class="form-control" id="nama_jenis" name="harga" required>
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

<!-- Modal ubah harga satuan-->
<div class="modal fade" id="edithargasatuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Ubah Harga Satuan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/editharga')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_harga" id="id_harga" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="form-group">
					<label for="exampleInputEmail1">Harga</label>
					<input type="text" class="form-control" id="harga" name="harga" required>
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
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('#harga_kiloan').DataTable()
    $('#harga_satuan').DataTable()

    @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif

  	$('#edithargakiloan').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_harga').val(id);
        modal.find('#harga').val("");
        
        $.ajax({
          url : 'getharga/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
          	modal.find('#harga').val(data.harga);
          },
        });
  	});

  	$('button#deleteharga').on('click',function(e){
	    e.preventDefault();
	    var form = $(this).parents('form');
	    var nama = $(e.currentTarget).attr('data-name');
	    var tabel = $(e.currentTarget).attr('data-table');
	    swal({
	      title: 'Hapus',
	      text: "Apakah anda yakin akan menghapus data harga ini ? ",
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

	$('#edithargasatuan').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_harga').val(id);
        modal.find('#harga').val("");
        
        $.ajax({
          url : 'getharga/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
          	modal.find('#harga').val(data.harga);
          },
        });
  	});

  	$('button#deleteharga').on('click',function(e){
	    e.preventDefault();
	    var form = $(this).parents('form');
	    var nama = $(e.currentTarget).attr('data-name');
	    var tabel = $(e.currentTarget).attr('data-table');
	    swal({
	      title: 'Hapus',
	      text: "Apakah anda yakin akan menghapus data harga ini ? ",
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