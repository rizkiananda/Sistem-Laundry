<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\harga;
use App\Model\jenis_layanan;
use App\Model\jenis_paket;
use App\Model\jenis_pakaian;

class HargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daftarHarga(){
    	$layanan_kiloans = jenis_layanan::where([['id_jenis_laundry', 1],['status', 'aktif']])->get();
    	$layanan_satuans = jenis_layanan::where([['id_jenis_laundry', 2],['status', 'aktif']])->get();
    	$jenis_pakets = jenis_paket::where('status', 'aktif')->get();
		$jenis_pakaians = jenis_pakaian::where('status', 'aktif')->get();
        $hargas = harga::where('status', 'aktif')->get();
		return view('sistem.daftarharga', ['layanan_kiloans'=>$layanan_kiloans, 'layanan_satuans'=>$layanan_satuans, 'jenis_pakets'=>$jenis_pakets, 'jenis_pakaians'=>$jenis_pakaians, 'hargas'=>$hargas]); 
    }

    public function tambahHarga(Request $request){
        $jenis_layanan = $request['jenis_layanan'];
    	$jenis_pakaian = $request['jenis_pakaian'];
    	$jenis_paket = $request['jenis_paket'];
    	$harga = $request['harga'];
        $hargadb_kiloans = harga::where([['id_jenis_layanan', $jenis_layanan],['id_jenis_paket', $jenis_paket], ['status', 'aktif']])->get();
        $status_kiloan = "tidak ada";
        $hargadb_satuans = harga::where([['id_jenis_layanan', $jenis_layanan],['id_jenis_paket', $jenis_paket], ['id_jenis_pakaian', $jenis_pakaian], ['status', 'aktif']])->get();
        $status_satuan = "tidak ada";

        // foreach ($hargadb_kiloans as $hargadb_kiloan) {
        //     if($hargadb_kiloan->id_jenis_layanan==$jenis_layanan && $hargadb_kiloan->id_jenis_paket==$jenis_paket){
        //         $status_kiloan = "ada";
                
        //     }
        // }
        if($hargadb_kiloans != null){
             $status_kiloan = "ada";
        }
        if($hargadb_satuans != null){
             $status_satuan = "ada";
        }


    	if($jenis_layanan!="null" && $jenis_paket!="null" && $jenis_pakaian=="null"){
            if($status_kiloan=="tidak ada"){
                harga::create([
                    'id_jenis_layanan'=> $jenis_layanan,
                    'id_jenis_paket'=> $jenis_paket,
                    'harga'=> $harga, 
                    'status'=> 'aktif'
                    ]);
                }
            else{   
                $notification = array('title'=> 'Peringatan!','msg'=>'Data harga sudah ada!','alert-type'=>'warning');
                return redirect()->back()->with($notification);
            }
        }
    	elseif($jenis_layanan!="null" && $jenis_paket!="null" && $jenis_pakaian!="null"){
    		if($status_satuan=="tidak ada"){
                harga::create([
                'id_jenis_layanan'=> $jenis_layanan,    
    			'id_jenis_pakaian'=> $jenis_pakaian,
    			'id_jenis_paket'=> $jenis_paket,
    			'harga'=> $harga, 
    			'status'=> 'aktif'
    			]);
            }
            else{
                $notification = array('title'=> 'Peringatan!','msg'=>'Data harga sudah ada!','alert-type'=>'warning');
                return redirect()->back()->with($notification);
            }
    	}
        else{
            $notification = array('title'=> 'Peringatan!','msg'=>'Isi data harga dengan lengkap!','alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }
    	
	    $notification = array('title'=> 'Berhasil!','msg'=>'Data harga berhasil ditambahkan!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function singleHarga($id){
        $harga = harga::where('id', $id)->first();
        return $harga;
    }

    public function editHarga(Request $request){
        $id_harga = $request['id_harga'];
        $harga = $request['harga'];

        harga::where('id', $id_harga)->update([
            'harga'=>$harga
        ]);
        $notification = array('title'=> 'Berhasil!','msg'=>'data harga berhasil diedit!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function deleteHarga($id){
        harga::where('id',$id)->update([
            'status'=>'nonaktif'
        ]);
        $notification = array('title'=> 'Berhasil!', 'msg'=>'Data harga berhasil dihapus!','alert-type'=>'success');
        return redirect('/daftarharga')->with($notification);
    }
}

