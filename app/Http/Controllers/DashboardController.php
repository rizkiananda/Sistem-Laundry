<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\rekap;
use App\Model\transaksi;
use HighCharts;

class DashboardController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function dashboard(Request $request){
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

      //chart pendapatan perbulan dalam 1 tahun
      $filter_tahun = $request['filtertahun'];
      if($filter_tahun==null){
        for($i=1; $i<=12; $i++){
          $pendapatan = 0;
          $rekaps = rekap::where('status_laundry', 'selesai')->whereMonth('tanggal_masuk', '=', $i)->whereYear('tanggal_masuk', '=', date('Y'))->get();
          if($rekaps==null){
            $nominal_tahunini[] = 0;
          }
          else{
            foreach($rekaps as $rekap){
              $pendapatan = $pendapatan + $rekap->total;
            }
            $nominal_tahunini[] = $pendapatan;
          }
        }
        $json_nominaltahunini = json_encode($nominal_tahunini);
        $json_tahunini = json_encode(date('Y'));
      }
      else{
        for($i=1; $i<=12; $i++){
          $pendapatan = 0;
          $rekaps = rekap::where('status_laundry', 'selesai')->whereMonth('tanggal_masuk', '=', $i)->whereYear('tanggal_masuk', '=', $filter_tahun)->get();
          if($rekaps==null){
            $nominal_tahunini[] = 0;
          }
          else{
            foreach($rekaps as $rekap){
              $pendapatan = $pendapatan + $rekap->total;
            }
            $nominal_tahunini[] = $pendapatan;
          }
        }
        $json_nominaltahunini = json_encode($nominal_tahunini);
        $json_tahunini = json_encode($filter_tahun);
      }

      //chart pendapatan pertanggal dalam 1 bulan
      $filterbulan = $request['filterbulan'];
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

      if($filterbulan==null){
        for($i=1; $i<=31; $i++){
          $pendapatan = 0;
          $tanggal[] = $i;
          $rekaps = rekap::where('status_laundry', 'selesai')->whereDay('tanggal_masuk', '=', $i)->whereMonth('tanggal_masuk', '=', date('m'))->get();
          if($rekaps==null){
            $nominal_bulanini[] = 0;
          }
          else{
            foreach($rekaps as $rekap){
              $pendapatan = $pendapatan + $rekap->total;
            }
            $nominal_bulanini[] = $pendapatan;
          }
        }
        $json_nominalbulanini = json_encode($nominal_bulanini);
        $json_bulanini = json_encode(date('F'));
        $json_tanggal = json_encode($tanggal);
      }
      else{
        for($i=1; $i<=31; $i++){
          $pendapatan = 0;
          $tanggal[] = $i;
          $rekaps = rekap::where('status_laundry', 'selesai')->whereDay('tanggal_masuk', '=', $i)->whereMonth('tanggal_masuk', '=', $filterbulan)->get();
          if($rekaps==null){
            $nominal_bulanini[] = 0;
          }
          else{
            foreach($rekaps as $rekap){
              $pendapatan = $pendapatan + $rekap->total;
            }
            $nominal_bulanini[] = $pendapatan;
          }
        }
        $json_nominalbulanini = json_encode($nominal_bulanini);
        $json_bulanini = json_encode($filter_bulan);
        $json_tanggal = json_encode($tanggal);
      }
      

      //chart kiloan perbulan dalam 1 tahun
      $filtertahun = $request['filter_tahun'];
      if($filtertahun==null){
        for($i=1; $i<=12; $i++){
          $berat = 0;
          $transaksis = transaksi::whereMonth('tanggal_masuk', '=', $i)->whereYear('tanggal_masuk', '=', date('Y'))->get();
          if($transaksis==null){
            $berat_tahunini[] = 0;
          }
          else{
            foreach($transaksis as $transaksi){
              $berat = $berat + $transaksi->berat;
            }
            $berat_tahunini[] = $berat;
          }
        }
        $json_berattahunini = json_encode($berat_tahunini);
      }
      else{
        for($i=1; $i<=12; $i++){
          $berat = 0;
          $transaksis = transaksi::whereMonth('tanggal_masuk', '=', $i)->whereYear('tanggal_masuk', '=', $filtertahun)->get();
          if($transaksis==null){
            $berat_tahunini[] = 0;
          }
          else{
            foreach($transaksis as $transaksi){
              $berat = $berat + $transaksi->berat;
            }
            $berat_tahunini[] = $berat;
          }
        }
        $json_berattahunini = json_encode($berat_tahunini);
        $json_tahunini = json_encode($filtertahun);
      }
      

      //chart pendapatan kiloan dan satuan
      $tahun_kiloansatuan = $request['filter_tahun'];
      if($tahun_kiloansatuan ==null){
        for($i=1; $i<=12; $i++){
          $kiloan = 0;
          $satuan = 0;
          $transaksis = transaksi::whereMonth('tanggal_masuk', '=', $i)->whereYear('tanggal_masuk', '=', date('Y'))->get();
          if($transaksis==null){
            $pendapatan_kiloan[] = 0;
            $pendapatan_satuan[] = 0;
          }
          else{
            foreach($transaksis as $transaksi){
              if($transaksi->berat!=null && $transaksi->rekap->status_laundry == "selesai"){
                 $kiloan = $kiloan + $transaksi->subtotal;
              }
              elseif($transaksi->berat==null && $transaksi->rekap->status_laundry == "selesai"){
                $satuan = $satuan + $transaksi->subtotal;
              }
            }
            $pendapatan_kiloan[] = $kiloan;
            $pendapatan_satuan[] = $satuan;
          }
        }
        $json_pendapatankiloan = json_encode($pendapatan_kiloan);
        $json_pendapatansatuan = json_encode($pendapatan_satuan);
      }
      else{
        for($i=1; $i<=12; $i++){
          $kiloan = 0;
          $satuan = 0;
          $transaksis = transaksi::whereMonth('tanggal_masuk', '=', $i)->whereYear('tanggal_masuk', '=', $tahun_kiloansatuan)->get();
          if($transaksis==null){
            $pendapatan_kiloan[] = 0;
            $pendapatan_satuan[] = 0;
          }
          else{
            foreach($transaksis as $transaksi){
              if($transaksi->berat!=null && $transaksi->rekap->status_laundry == "selesai"){
                 $kiloan = $kiloan + $transaksi->subtotal;
              }
              elseif($transaksi->berat==null && $transaksi->rekap->status_laundry == "selesai"){
                $satuan = $satuan + $transaksi->subtotal;
              }
            }
            $pendapatan_kiloan[] = $kiloan;
            $pendapatan_satuan[] = $satuan;
          }
        }
        $json_pendapatankiloan = json_encode($pendapatan_kiloan);
        $json_pendapatansatuan = json_encode($pendapatan_satuan);
         $json_tahunini = json_encode($tahun_kiloansatuan);
      }
      

  	  return view('sistem.dashboard', ['pendapatan_hariini'=> $pendapatan_hariini, 'pendapatan_bulanini'=> $pendapatan_bulanini, 'berat_bulanini'=>$berat_bulanini, 'antrian'=>$antrian, 'nominal_tahunini'=>$json_nominaltahunini, 'tahun_ini'=>$json_tahunini, 'nominal_bulanini'=>$json_nominalbulanini, 'bulan_ini'=>$json_bulanini, 'tanggal'=>$json_tanggal, 'berat_tahunini'=>$json_berattahunini, 'pendapatan_kiloan'=>$json_pendapatankiloan, 'pendapatan_satuan'=>$json_pendapatansatuan]);
  }
  
}
