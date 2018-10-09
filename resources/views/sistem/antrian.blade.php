@extends('layout.sistem')
@section('title', 'Laundry - antrian')
@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="container">
	<h3>Daftar Antrian</h3>
	<hr style="border: 5px solid #1c7bd9; border-radius: 5px">
	<br>          

	<div class="box box-info" style="border: 1px solid #00c0ef; border-top: 5px solid #00c0ef;">
		<div class="box-header with-border" style="text-align: center">
			<h3 class="box-title"><b>Daftar Antrian</b></h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="antrian" class="table table-bordered table-striped" style="text-align: center">
					<thead >
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Tanggal Laundry</th>
							<th style="text-align: center;">Nama Pelanggan</th>
							<th style="text-align: center;">Telepon</th>
							<th style="text-align: center;">Total Laundry</th>
							<th style="text-align: center;">Status</th>
							<th style="text-align: center;">Nota</th>
							<th style="text-align: center;">Pembayaran</th>
							<th style="text-align: center;">Status Laundry</th>
						</tr>
					</thead>
					<tbody>
						@foreach($antrians as $index => $antrian)
						<tr>
							<td>{{$index+1}}</td>
							<td>{{$antrian->tanggal_masuk}}</td>
							<td>{{$antrian->pelanggan->nama_pelanggan}}</td>
							<td>{{$antrian->pelanggan->no_telp}}</td>
							<td>{{$antrian->total}}</td>
							@if($antrian->bayar - $antrian->total >= 0)
							<td><span class="label label-success" style="font-size: 15px">Lunas</span></td>
							@else
							<td><span class="label label-danger" style="font-size: 15px">Belum Lunas</span></td>
							@endif
				            <td>
				              <a href="{{url('/invoice/'.$antrian->id)}}"><i class="fas fa-file" style="font-size: 20px"></i></a>
				            </td>
				            <td>
				              <a href="{{url('/pembayaran/'.$antrian->id)}}"><i class="fa fa-credit-card" style="font-size: 20px"></i></a>
				            </td>
				            <td>
								<div class="dropdown">
								  <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu{{$antrian->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    {{$antrian->status_laundry}}
								    <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{$antrian->id}}">
								    <form id="my_form" method="POST" action="{{url('/selesailaundry')}}" enctype="multipart/form-data">
									{{csrf_field()}}
								    <input name="_method" type="hidden" value="PUT">
								    <input type="text" name="id_antrian" id="id_antrian" value="{{$antrian->id}}" hidden>
								    <li><a href="javascript::void(0)" id="ubahstatus">Selesai</a></li>
								    </form>
								  </ul>
								</div>
								{{-- <form id="my_form" method="POST" action="{{url('/selesailaundry')}}" enctype="multipart/form-data">
									{{csrf_field()}}
								<input name="_method" type="hidden" value="PUT">
								    <input type="text" name="id_antrian" id="id_antrian" value="{{$antrian->id}}" hidden>	
								<select id="ubahstatus" class="form-control" name="" >
								<option selected="true" value="">{{$antrian->status_laundry}}</option>
								<option value="">selesai</option>
								</select>
								</form> --}}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
$('#antrian').DataTable()
    @if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
  	@endif

  	$('a#ubahstatus').on('click',function(e){
	    e.preventDefault();
	    var form = $(this).parents('form');
	    var nama = $(e.currentTarget).attr('data-name');
	    var tabel = $(e.currentTarget).attr('data-table');
	    swal({
	      title: 'Hapus',
	      text: "Apakah anda yakin akan mengubah status laundry ini ? ",
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Yakin',
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