<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\rekap;

class RekapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function laporanHariIni(){
    	$current_date = date('Y-m-d');
     	$rekaps = rekap::where([['status_laundry', 'selesai'],['tanggal_masuk', $current_date]])->get();
     	$pendapatan = 0;
     	foreach($rekaps as $rekap){
     		$pendapatan = $pendapatan + $rekap->total;
     	}
      $status = "tanggal";
    	return view('sistem.laporan', ['rekaps'=>$rekaps, 'status'=>$status,'tanggal_laporan'=>$current_date, 'pendapatan'=>$pendapatan]);
    }

    public function laporanBulanIni(){
    	$current_date =date('Y-m-d');
     	$rekaps = rekap::where('status_laundry', 'selesai')->whereMonth('tanggal_masuk', '=', date('m'))->get();
     	$pendapatan = 0;
     	foreach($rekaps as $rekap){
     		$pendapatan = $pendapatan + $rekap->total;
     	}
     $status = "bulan";
    	return view('sistem.laporan', ['rekaps'=>$rekaps, 'status'=>$status,'tanggal_laporan'=>$current_date, 'pendapatan'=>$pendapatan]);
    }
    
    public function filterTanggal(Request $request){
    	$filtertanggal = $request['filtertanggal'];
    	$rekaps = rekap::where([['status_laundry', 'selesai'],['tanggal_masuk', $filtertanggal]])->get();
     	$pendapatan = 0;
     	foreach($rekaps as $rekap){
     		$pendapatan = $pendapatan + $rekap->total;
     	}
      // $filter_bulan = null;
      $status = "tanggal";
     	return view('sistem.laporan', ['rekaps'=>$rekaps, 'status'=>$status,'tanggal_laporan'=>$filtertanggal,'pendapatan'=>$pendapatan]);
    }

    public function filterBulan(Request $request){
    	$filterbulan = $request['filterbulan'];
    	$filtertahun = $request['filtertahun'];
      if($filterbulan=="01"){
        $filter_bulan = "Januari";
      }
      elseif($filterbulan=="02"){
        $filter_bulan = "Februari";
      }
      elseif($filterbulan=="03"){
        $filter_bulan = "Maret";
      }
      elseif($filterbulan=="04"){
        $filter_bulan = "April";
      }
      elseif($filterbulan=="05"){
        $filter_bulan = "Mei";
      }
      elseif($filterbulan=="06"){
        $filter_bulan = "Juni";
      }
      elseif($filterbulan=="07"){
        $filter_bulan = "Juli";
      }
      elseif($filterbulan=="08"){
        $filter_bulan = "Agustus";
      }
      elseif($filterbulan=="09"){
        $filter_bulan = "September";
      }
      elseif($filterbulan=="10"){
        $filter_bulan = "Oktober";
      }
      elseif($filterbulan=="11"){
        $filter_bulan = "November";
      }
      elseif($filterbulan=="12"){
        $filter_bulan = "Desember";
      }
      else{
        $filter_bulan = null;
      }

    	// 
      $status = "filterbulan";
    	$rekaps =  rekap::where('status_laundry', 'selesai')->whereMonth('tanggal_masuk', '=', $filterbulan)->whereYear('tanggal_masuk', '=', $filtertahun)->get();
     	$pendapatan = 0;
     	foreach($rekaps as $rekap){
     		$pendapatan = $pendapatan + $rekap->total;
     	}
     	return view('sistem.laporan', ['rekaps'=>$rekaps, 'status'=>$status,'laporan_bulanan'=>$filter_bulan, 'filter_tahun'=>$filtertahun,'pendapatan'=>$pendapatan]);
    }

    public function filterTahun(Request $request){
      $filtertahun = $request['filtertahun'];
      $rekaps =  rekap::where('status_laundry', 'selesai')->whereYear('tanggal_masuk', '=', $filtertahun)->get();
      $pendapatan = 0;
      foreach($rekaps as $rekap){
        $pendapatan = $pendapatan + $rekap->total;
      }
      $status = "filtertahun";
      return view('sistem.laporan', ['rekaps'=>$rekaps, 'status'=>$status,'filter_tahun'=>$filtertahun,'pendapatan'=>$pendapatan]);
    }
}
