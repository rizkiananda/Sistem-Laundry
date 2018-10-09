<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\rekap;
use App\Model\transaksi;

class DashboardController extends Controller
{
    public function dashboard(){
    	//pendapatan hari ini
    	$current_date = date('Y-m-d');
       	$rekaps = rekap::where([['status_laundry', 'selesai'],['tanggal_masuk', $current_date]])->get();
       	if($rekaps==null){
       		$rekaps->total = 0;
       	}
       	$pendapatan_hariini = 0;
       	foreach($rekaps as $rekap){
       		$pendapatan_hariini = $pendapatan_hariini + $rekap->total;
       	}
       	//pendapatan bulan ini
       	$rekapss = rekap::where('status_laundry', 'selesai')->whereMonth('tanggal_masuk', '=', date('m'))->get();
       	$pendapatan_bulanini = 0;
       	foreach($rekapss as $rekap){
       		$pendapatan_bulanini = $pendapatan_bulanini + $rekap->total;
       	}
       	//total berat laundry bulan ini
       	$berat_bulanini = 0;
       	$berat_transaksis = transaksi::where('berat', '!=', null)->whereMonth('tanggal_masuk', '=', date('m'))->get();
       	foreach($berat_transaksis as $berat_transaksi){
       		$berat_bulanini = $berat_bulanini + $berat_transaksi->berat;
       	}
       	//Antrian saat ini
       	$antri = rekap::where('status_laundry', 'proses')->get();
       	$antrian = count($antri);
    	return view('sistem.dashboard', ['pendapatan_hariini'=> $pendapatan_hariini, 'pendapatan_bulanini'=> $pendapatan_bulanini, 'berat_bulanini'=>$berat_bulanini, 'antrian'=>$antrian]);
    }
}
