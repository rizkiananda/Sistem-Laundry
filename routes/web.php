<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// menu
	
Route::get('/login', function () {
		// $gambar = base64_encode(realpath('C:\Users\Asus\Pictures\alifka.png'));
		// return view('auth.login',['gambar'=>$gambar]);
		return view('auth.login');
	});

//User Guide
// Route::get('/downloadUserGuide', 'PDFController@downloadUserGuide');

Auth::routes();

Route::group(['middleware' => ['auth','revalidate']],function(){
	//dashboard
	Route::get('/', 'DashboardController@dashboard');
	Route::get('/filter_pendapatanpertahun', 'DashboardController@filterPendapatanpertahun');
	// pelayanan
	Route::get('/pelayanan', 'PelayananController@getPelayanan');
	Route::get('/getlayanan/{id}', 'PelayananController@singleLayanan');
	Route::post('/tambahkiloan', 'PelayananController@tambahKiloan');
	Route::post('/tambahsatuan', 'PelayananController@tambahSatuan');
	Route::put('/editlayanan', 'PelayananController@editLayanan');
	Route::delete('/hapuslayanan/{id}', 'PelayananController@deleteLayanan');
	

	Route::post('/tambahpaket', 'PelayananController@tambahPaket');
	Route::get('/getpaket/{id}', 'PelayananController@singlePaket');
	Route::put('/editpaket', 'PelayananController@editPaket');
	Route::delete('/hapuspaket/{id}', 'PelayananController@deletePaket');

	Route::post('/tambahpakaian', 'PelayananController@tambahPakaian');
	Route::get('/getpakaian/{id}', 'PelayananController@singlePakaian');
	Route::put('/editpakaian', 'PelayananController@editPakaian');
	Route::delete('/hapuspakaian/{id}', 'PelayananController@deletePakaian');

	//daftarharga
	Route::get('/daftarharga', 'HargaController@daftarHarga');
	Route::post('/tambahharga', 'HargaController@tambahHarga');
	Route::get('/getharga/{id}', 'HargaController@singleHarga');
	Route::put('/editharga', 'HargaController@editHarga');
	Route::delete('/hapusharga/{id}', 'HargaController@deleteHarga');

	//Transaksi
	Route::get('/transaksi', 'TransaksiController@transaksi');
	Route::post('/tambahpelanggan', 'TransaksiController@tambahPelanggan');
	Route::post('/cekhargakiloan', 'TransaksiController@cekHargakiloan');
	Route::post('/keranjangkiloan', 'TransaksiController@keranjangKiloan');
	Route::post('/cekhargasatuan', 'TransaksiController@cekHargasatuan');
	Route::post('/keranjangsatuan', 'TransaksiController@keranjangSatuan');
	Route::get('/gettransaksi/{id}', 'TransaksiController@getTransaksi');
	Route::put('/edittransaksi', 'TransaksiController@editTransaksi');
	Route::delete('/hapustransaksi/{id}', 'TransaksiController@deleteTransaksi');
	Route::post('/rekaptransaksi', 'TransaksiController@rekapTransaksi');
	Route::get('/transaksi_edit', 'TransaksiController@transaksiEdit');

	//pembayaran
	Route::get('/pembayaran/{id}', 'PembayaranController@pembayaran');
	Route::put('/bayar', 'PembayaranController@bayar');
	Route::get('/invoice/{id}', 'PembayaranController@invoice');

	//antrian
	Route::get('/antrian', 'AntrianController@antrian');
	Route::put('/selesailaundry', 'AntrianController@selesaiLaundry');

	//laporan
	Route::get('/laporan', 'RekapController@laporanBulanIni');
	Route::get('/laporan_hariini', 'RekapController@laporanHariIni');
	Route::get('/filtertanggal', 'RekapController@filterTanggal');
	Route::get('/filterbulan', 'RekapController@filterBulan');
	Route::get('/filtertahun', 'RekapController@filterTahun');
	

	// Route::get('/invoice', 'invoiceController@invoice');

	Route::get('/logout', function(){
		auth()->logout();
	});


});
// Route::get('/gambar', function(){
// 		$gambar = base64_encode(file_get_contents(realpath('C:\Users\Asus\Pictures\alifka.png')));
// 		return view('welcome',['gambar'=>$gambar]);
// 	});

