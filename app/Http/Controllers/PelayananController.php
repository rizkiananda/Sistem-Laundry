<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\jenis_layanan;
use App\Model\jenis_paket;
use App\Model\jenis_pakaian;


class PelayananController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    //tampilan pelayanan//
	public function getPelayanan(){
		$layanan_kiloans = jenis_layanan::where([['id_jenis_laundry', 1],['status', 'aktif']])->get();
		$layanan_satuans = jenis_layanan::where([['id_jenis_laundry', 2],['status', 'aktif']])->get();
		$jenis_pakets = jenis_paket::where('status', 'aktif')->get();
		$jenis_pakaians = jenis_pakaian::where('status', 'aktif')->get();
		return view('sistem.pelayanan', ['layanan_kiloans'=>$layanan_kiloans, 'layanan_satuans'=>$layanan_satuans, 'jenis_pakets'=>$jenis_pakets, 'jenis_pakaians'=>$jenis_pakaians]);
	}
	// end //

	// CRUD pelayanan //
	//layanan
    public function tambahSatuan(Request $request){
    	$nama = $request['nama_satuan'];

    	jenis_layanan::create([
			'id_jenis_laundry'=> 2,
			'nama_layanan'=>$nama,
			'status'=> 'aktif'
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data layanan berhasil ditambahkan!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function singleLayanan($id){
		$layanan = jenis_layanan::where('id', $id)->first();
		return $layanan;
	}

    public function editLayanan(Request $request){
    	$id_layanan = $request['id_layanan'];
    	$nama = $request['nama_layanan'];

    	jenis_layanan::where('id', $id_layanan)->update([
			'nama_layanan'=>$nama
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'data layanan berhasil diedit!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function deleteLayanan($id){
    	$nama = jenis_layanan::find($id)->nama_layanan;
    	jenis_layanan::where('id',$id)->update([
			'status'=>'nonaktif'
		]);
		$notification = array('title'=> 'Berhasil!', 'msg'=>'Data layanan '.$nama.' berhasil dihapus!','alert-type'=>'success');
		return redirect('/pelayanan')->with($notification);
    }

    //paket
    public function tambahPaket(Request $request){
    	$nama = $request['nama_paket'];

    	jenis_paket::create([
			'nama_paket'=>$nama,
			'status'=> 'aktif'
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data paket berhasil ditambahkan!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function singlePaket($id){
		$paket = jenis_paket::where('id', $id)->first();
		return $paket;
	}

	public function editPaket(Request $request){
    	$id_paket = $request['id_paket'];
    	$nama = $request['nama_paket'];

    	jenis_paket::where('id', $id_paket)->update([
			'nama_paket'=>$nama
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data Paket berhasil diedit!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function deletePaket($id){
    	$nama = jenis_paket::find($id)->nama_paket;
    	jenis_paket::where('id',$id)->update([
			'status'=>'nonaktif'
		]);
		$notification = array('title'=> 'Berhasil!', 'msg'=>'Data paket '.$nama.' berhasil dihapus!','alert-type'=>'success');
		return redirect('/pelayanan')->with($notification);
    }

    //pakaian
    public function tambahPakaian(Request $request){
    	$nama = $request['nama_pakaian'];

    	jenis_pakaian::create([
			'nama_pakaian'=>$nama,
			'status'=> 'aktif'
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data jenis pakaian berhasil ditambahkan!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function singlePakaian($id){
		$pakaian = jenis_pakaian::where('id', $id)->first();
		return $pakaian;
	}

	public function editPakaian(Request $request){
    	$id_pakaian = $request['id_pakaian'];
    	$nama = $request['nama_pakaian'];

    	jenis_pakaian::where('id', $id_pakaian)->update([
			'nama_pakaian'=>$nama
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data jenis pakaian berhasil diedit!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

     public function deletePakaian($id){
    	$nama = jenis_pakaian::find($id)->nama_pakaian;
    	jenis_pakaian::where('id',$id)->update([
			'status'=>'nonaktif'
		]);
		$notification = array('title'=> 'Berhasil!', 'msg'=>'Data pakaian '.$nama.' berhasil dihapus!','alert-type'=>'success');
		return redirect('/pelayanan')->with($notification);
    }

    // end //
}
