<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\rekap;

class AntrianController extends Controller
{
    public function antrian(){
    	$antrians = rekap::where('status_laundry', "proses")->get();
    	return view('sistem.antrian', ['antrians' => $antrians]);
    }

    public function selesaiLaundry(Request $request){
    	$id_antrian = $request['id_antrian'];
    	rekap::where('id', $id_antrian)->update([
    		'status_laundry' => "selesai"
    	]);
    $notification = array('title'=> 'Berhasil!','msg'=>'Status laundry berhasil diubah!','alert-type'=>'success');
    return redirect()->back()->with($notification);
    }
}
