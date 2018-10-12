<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\rekap;
use App\Model\transaksi;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pembayaran($id){
    	$data_pembayaran = transaksi::where('id_rekap', $id)->first();
    	$transaksis = transaksi::where('id_rekap', $id)->get();
    	$sisa = $data_pembayaran->rekap->total - $data_pembayaran->rekap->bayar;
        $kembali = $data_pembayaran->rekap->bayar - $data_pembayaran->rekap->total;
    	if($sisa < 0){
    		$sisa = 0;
    	}
        if($kembali < 0){
            $kembali = 0;
        }
    	return view('sistem.pembayaran', ['data_pembayaran'=>$data_pembayaran, 'transaksis'=>$transaksis, 'sisa'=>$sisa, 'kembali'=>$kembali]);
    }

    public function bayar(Request $request){
    	$id_pembayaran = $request['id_pembayaran'];
    	$bayar = $request['bayar'];
    	$bayardb = rekap::where('id', $id_pembayaran)->first();
    	$sudah_dibayar = $bayardb->bayar;
    	$tambah_bayar = $bayar + $sudah_dibayar;

    	rekap::where('id', $id_pembayaran)->update([
    		'bayar' => $tambah_bayar
    	]);
    	$notification = array('title'=> 'Berhasil!', 'msg'=>'Data pembayaran berhasil disimpan!','alert-type'=>'success');
		return redirect('/antrian')->with($notification);
    }

    public function invoice($id){
    	$data_pembayaran = transaksi::where('id_rekap', $id)->first();
    	$transaksis = transaksi::where('id_rekap', $id)->get();
    	$sisa = $data_pembayaran->rekap->total - $data_pembayaran->rekap->bayar;
    	$kembali = $data_pembayaran->rekap->bayar - $data_pembayaran->rekap->total;
    	if($sisa < 0){
    		$sisa = 0;
    	}
    	if($kembali < 0){
    		$kembali = 0;
    	}
    	return view('sistem.invoice', ['data_pembayaran'=>$data_pembayaran, 'transaksis'=>$transaksis, 'sisa'=>$sisa, 'kembali'=>$kembali]);
    }
   
}
