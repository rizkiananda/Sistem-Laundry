@extends('layout.sistem')
@section('title', 'Laundry - pelayanan')

@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/tab.css')}}">
@endsection

@section('content')
<div class="container">
	<h3>Jenis Layanan</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>
	<div class="row">
	{{-- KILOAN --}}
		<div class="col-md-6">
			<button class="btn btn-success" data-toggle="modal" data-target="#kiloan"><i class="fas fa-plus"></i> Tambah layanan</button>
			<br><br>
			<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
				<div class="box-header with-border" style="text-align: center">
					<h3 class="box-title"><b>Layanan Kiloan</b></h3>
				</div>
				<div class="box-body" >
					<div class="table-responsive">
						<table id="layanan_kiloan" class="table table-bordered table-striped" style="text-align: center;">
							<thead>
					            <tr>
					              <th class="text-center"> No. </th>
					              <th class="text-center"> Nama layanan </th>
					              <th></th>
					            </tr>
				          	</thead>

				          <tbody>
				          	@foreach($layanan_kiloans as $index => $layanan_kiloan)
				            <tr class="edit" id="detail">
				              <td id="no" class="text-center">{{$index+1}}</td>
				              <td id="name" class="text-center"> {{$layanan_kiloan->nama_layanan}} </td>
				              <td>
				              
				              <form method="POST" action="{{url('/hapuslayanan/'.$layanan_kiloan->id)}}" enctype="multipart/form-data">
				              <button class="btn btn-warning" id="edit" data-toggle="modal" data-target="#editkiloan" data-id="{{$layanan_kiloan->id}}" type="button"><i class="fa fa-edit"></i> Edit</button>

				              <input type="hidden" name="_method" value="DELETE"/>
				              <button class="btn btn-danger" id="deletelayanan" type="submit" data-id="{{$layanan_kiloan->id}}" data-name="{{$layanan_kiloan->nama_layanan}}"><i class="fas fa-trash-alt"></i> Hapus
				              </button>
				              {{csrf_field()}}
				              </form>
				              </td>
				            </tr>
				            @endforeach
				          </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		
		 {{-- SATUAN --}}
		<div class="col-md-6">
		    <button class="btn btn-success" data-toggle="modal" data-target="#satuan"><i class="fas fa-plus"></i> Tambah layanan</button>
			<br><br>

			<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
				<div class="box-header with-border" style="text-align: center;">
					<h3 class="box-title"><b>Layanan Satuan</b></h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="layanan_satuan" class="table table-bordered table-striped" style="text-align: center;">
							<thead>
					            <tr>
					              <th class="text-center"> No. </th>
					              <th class="text-center"> Nama layanan </th>
					              <th></th>
					            </tr>
				          	</thead>
			         	 	<tbody>
			         	 		@foreach($layanan_satuans as $index => $layanan_satuan)
					            <tr class="edit" id="detail">
					              <td id="no" class="text-center"> {{$index+1}} </td>
					              <td id="name" class="text-center"> {{$layanan_satuan->nama_layanan}} </td>
					              <td>
					              <form method="POST" action="{{url('/hapuslayanan/'.$layanan_satuan->id)}}" enctype="multipart/form-data">
					              <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editsatuan" data-id="{{$layanan_satuan->id}}"><i class="fa fa-edit"></i> Edit</button>
					              <input type="hidden" name="_method" value="DELETE"/>
					              <button class="btn btn-danger" id="deletelayanan" type="submit" data-id="{{$layanan_kiloan->id}}" data-name="{{$layanan_kiloan->nama_layanan}}"><i class="fas fa-trash-alt"></i> Hapus</button>
					              {{csrf_field()}}
					              </form>
					              </td>
					            </tr>
					         	
					            @endforeach
		          			</tbody>
						</table>
					</div>
				</div>
			</div>
	    </div>
	</div>

	{{-- jenis paket --}}
	<h3>Jenis Paket</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>

	<button class="btn btn-success" data-toggle="modal" data-target="#tambahpaket"><i class="fas fa-plus"></i> Tambah Paket</button>
		<br><br>
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border" style="text-align: center">
			<h3 class="box-title"><b>Jenis Paket</b></h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="jenis_paket" class="table table-bordered table-striped" style="text-align: center;">
					<thead>
			            <tr>
			              <th class="text-center"> No. </th>
			              <th class="text-center"> Nama Paket </th>
			              <th></th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach($jenis_pakets as $index => $jenis_paket)
			            <tr class="edit" id="detail">
			              <td id="no" class="text-center"> {{$index+1}} </td>
			              <td id="name" class="text-center"> {{$jenis_paket->nama_paket}} </td>
			              <td>
			              <form method="POST" action="{{url('/hapuspaket/'.$jenis_paket->id)}}" enctype="multipart/form-data">
			              <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editpaket" data-id="{{$jenis_paket->id}}"><i class="fa fa-edit"></i>  Edit</button>
			              <input type="hidden" name="_method" value="DELETE"/>
			              <button class="btn btn-danger" id="deletepaket" type="submit" data-id="{{$jenis_paket->id}}" data-name="{{$jenis_paket->nama_paket}}"><i class="fas fa-trash-alt"></i> Hapus</button>
			              {{csrf_field()}}
			              </form>
			              </td>			            
			            </tr>
			            @endforeach
		          	</tbody>
				</table>
			</div>
		</div>
	</div>

	{{-- jenis pakaian --}}
	<h3>Jenis Pakaian</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>

	<button class="btn btn-success" data-toggle="modal" data-target="#tambahpakaian"><i class="fas fa-plus"></i> Tambah Pakaian</button>
		<br><br>
	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border" style="text-align: center;">
			<h3 class="box-title"><b>Jenis Pakaian</b></h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="jenis_pakaian" class="table table-bordered table-striped" style="text-align: center;">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Nama Pakaian</th>
							<th></th>

						</tr>
					</thead>
					<tbody>
						@foreach($jenis_pakaians as $index => $jenis_pakaian)
						<tr>
							<td>{{$index+1}}</td>
							<td>{{$jenis_pakaian->nama_pakaian}}</td>
							<td>
							  <form method="POST" action="{{url('/hapuspakaian/'.$jenis_pakaian->id)}}" enctype="multipart/form-data">
				              <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editpakaian" data-id="{{$jenis_paket->id}}"><i class="fa fa-edit"></i>  Edit</button>
				              <input type="hidden" name="_method" value="DELETE"/>
				              <button class="btn btn-danger" id="deletepakaian" type="submit" data-id="{{$jenis_pakaian->id}}" data-name="{{$jenis_pakaian->nama_pakaian}}"><i class="fas fa-trash-alt"></i> Hapus</button>
				              {{csrf_field()}}
			              	  </form>
				            </td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal tambah layanan kiloan-->
<div class="modal fade" id="kiloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Layanan Kiloan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahkiloan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Layanan</label>
					<input type="text" class="form-control" id="nama_kiloan" name="nama_kiloan" required>
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

<!-- Modal edit layanan kiloan-->
<div class="modal fade" id="editkiloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Ubah Layanan Kiloan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/editlayanan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_layanan" id="id_kiloan" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Layanan</label>
					<input type="text" class="form-control" id="nama_kiloan" name="nama_layanan" required>
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

<!-- Modal tambah layanan satuan-->
<div class="modal fade" id="satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Layanan Satuan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahsatuan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Layanan</label>
					<input type="text" class="form-control" id="nama_satuan" name="nama_satuan" required>
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

<!-- Modal edit layanan satuan-->
<div class="modal fade" id="editsatuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Ubah Layanan Satuan</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/editlayanan')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_layanan" id="id_satuan" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Layanan</label>
					<input type="text" class="form-control" id="nama_satuan" name="nama_layanan" required>
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

<!-- Modal Tambah jenis paket-->
<div class="modal fade" id="tambahpaket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Jenis Paket</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahpaket')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Paket</label>
					<input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
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

<!-- Modal Edit jenis paket-->
<div class="modal fade" id="editpaket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Ubah Jenis Paket</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/editpaket')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_paket" id="id_paket" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Paket</label>
					<input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
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

<!-- Modal Tambah jenis pakaian-->
<div class="modal fade" id="tambahpakaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Tambah Jenis Pakaian</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/tambahpakaian')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Pakaian</label>
					<input type="text" class="form-control" id="nama_pakaian" name="nama_pakaian" required>
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

<!-- Modal Edit jenis pakaian-->
<div class="modal fade" id="editpakaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel" style="color: #ffffff;text-align: center"><b>Ubah Jenis Pakaian</b>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>
		        </h3>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/editpakaian')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="text" name="id_pakaian" id="id_pakaian" value="" hidden>
				<input name="_method" type="hidden" value="PUT">
				<div class="form-group">
					<label for="exampleInputEmail1">Nama Pakaian</label>
					<input type="text" class="form-control" id="nama_pakaian" name="nama_pakaian" required>
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
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $('#layanan_kiloan').DataTable()
    $('#layanan_satuan').DataTable()
    $('#jenis_paket').DataTable()
    $('#jenis_pakaian').DataTable()

    @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif
</script>

<script type="text/javascript">
  $('#editkiloan').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_kiloan').val(id);
        modal.find('#nama_kiloan').val("");
        
        $.ajax({
          url : 'getlayanan/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
          	modal.find('#nama_kiloan').val(data.nama_layanan);
          },
        });
  });

$('button#deletelayanan').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var nama = $(e.currentTarget).attr('data-name');
    var tabel = $(e.currentTarget).attr('data-table');
    swal({
      title: 'Hapus',
      text: "Apakah anda yakin akan menghapus Layanan "+nama+" ? ",
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

  $('#editsatuan').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_satuan').val(id);
        modal.find('#nama_satuan').val("");
        
        $.ajax({
          url : 'getlayanan/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
          	modal.find('#nama_satuan').val(data.nama_layanan);
          },
        });
  });

  $('#editpaket').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_paket').val(id);
        modal.find('#nama_paket').val("");
        
        $.ajax({
          url : 'getpaket/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
          	modal.find('#nama_paket').val(data.nama_paket);
          },
        });
  });

  $('button#deletepaket').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var nama = $(e.currentTarget).attr('data-name');
    var tabel = $(e.currentTarget).attr('data-table');
    swal({
      title: 'Hapus',
      text: "Apakah anda yakin akan menghapus Paket "+nama+" ? ",
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

    $('#editpakaian').on('show.bs.modal', function(event) {
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('#id_pakaian').val(id);
        modal.find('#nama_pakaian').val("");
        
        $.ajax({
          url : 'getpakaian/' + id,
          type: "GET",
          dataType: "json",
          success:function(data) {
          	modal.find('#nama_pakaian').val(data.nama_pakaian);
          },
        });
  });

  $('button#deletepakaian').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var nama = $(e.currentTarget).attr('data-name');
    var tabel = $(e.currentTarget).attr('data-table');
    swal({
      title: 'Hapus',
      text: "Apakah anda yakin akan menghapus Data pakaian "+nama+" ? ",
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

{{-- 'http://'+ window.location.host + --}}