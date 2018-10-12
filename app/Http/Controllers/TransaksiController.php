<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\pelanggan;
use App\Model\harga;
use App\Model\jenis_layanan;
use App\Model\jenis_paket;
use App\Model\jenis_pakaian;
use App\Model\keranjang;
use App\Model\transaksi;
use App\Model\rekap;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function transaksi(){
    	$pelanggans = pelanggan::all();
    	$layanan_kiloans = jenis_layanan::where([['id_jenis_laundry', 1],['status', 'aktif']])->get();
    	$layanan_satuans = jenis_layanan::where([['id_jenis_laundry', 2],['status', 'aktif']])->get();
    	$jenis_pakets = jenis_paket::where('status', 'aktif')->get();
		$jenis_pakaians = jenis_pakaian::where('status', 'aktif')->get();
		$keranjangs = keranjang::all();
		$total = 0;
		foreach($keranjangs as $keranjang){
			$total = $total + $keranjang->subtotal;
		}
    	return view('sistem.transaksi', ['pelanggans'=>$pelanggans, 'layanan_kiloans'=>$layanan_kiloans, 'layanan_satuans'=>$layanan_satuans, 'jenis_pakets'=>$jenis_pakets, 'jenis_pakaians'=>$jenis_pakaians, 'keranjangs'=>$keranjangs, 'total'=>$total]);
    }

    public function transaksiEdit(){
        $pelanggans = pelanggan::all();
        $layanan_kiloans = jenis_layanan::where([['id_jenis_laundry', 1],['status', 'aktif']])->get();
        $layanan_satuans = jenis_layanan::where([['id_jenis_laundry', 2],['status', 'aktif']])->get();
        $jenis_pakets = jenis_paket::where('status', 'aktif')->get();
        $jenis_pakaians = jenis_pakaian::where('status', 'aktif')->get();
        $keranjangs = keranjang::all();
        $total = 0;
        foreach($keranjangs as $keranjang){
            $total = $total + $keranjang->subtotal;
        }
        return view('sistem.transaksi_edit', ['pelanggans'=>$pelanggans, 'layanan_kiloans'=>$layanan_kiloans, 'layanan_satuans'=>$layanan_satuans, 'jenis_pakets'=>$jenis_pakets, 'jenis_pakaians'=>$jenis_pakaians, 'keranjangs'=>$keranjangs, 'total'=>$total]);
    }

    public function tambahPelanggan(Request $request){
    	$nama = $request['nama_pelanggan'];
    	$alamat = $request['alamat'];
    	$telp = $request['telepon'];

    	pelanggan::create([
			'nama_pelanggan'=>$nama,
			'alamat'=> $alamat,
			'no_telp' => $telp
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data pelanggan berhasil ditambahkan!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

    public function cekHargakiloan(Request $request){
    	$jenis_layanan = $request['jenis_layanan'];
    	$jenis_paket = $request['jenis_paket'];
        $harga = harga::where([['id_jenis_layanan', $jenis_layanan], ['id_jenis_paket', $jenis_paket], ['status', 'aktif']])->first();
        return $harga;
    }

   	public function keranjangKiloan(Request $request){
    	$jumlah_pakaian = $request['jumlah_pakaian'];
        $berat = $request['berat'];
    	$harga = $request['id_harga'];
    	$tgl_selesai = $request['tgl_selesai'];
    	$hargadb = harga::where('id', $harga)->first();
    	$bill = $hargadb->harga;
    	$subtotal = 0;

    	keranjang::create([
			'jumlah'=>$jumlah_pakaian,
			'berat'=> $berat,
			'id_harga' => $harga,
			'tanggal_selesai'=> $tgl_selesai,
			'subtotal'=> $subtotal=$bill*$berat
		]);
		$notification = array('title'=> 'Berhasil!','msg'=>'Data transaksi berhasil ditambahkan!','alert-type'=>'success');
		return redirect()->back()->with($notification);
    }

     public function cekHargasatuan(Request $request){
        $jenis_pakaian = $request['jenis_pakaian'];
        $jenis_layanan = $request['jenis_layanan'];
        $jenis_paket = $request['jenis_paket'];
        $harga = harga::where([['id_jenis_pakaian', $jenis_pakaian],['id_jenis_layanan', $jenis_layanan], ['id_jenis_paket', $jenis_paket], ['status', 'aktif']])->first();
        return $harga;
    }

    public function keranjangSatuan(Request $request){
        $jumlah_pakaian = $request['jumlah_pakaian'];
        $harga = $request['id_harga'];
        $tgl_selesai = $request['tgl_selesai'];
        $hargadb = harga::where('id', $harga)->first();
        $bill = $hargadb->harga;
        $subtotal = 0;

        keranjang::create([
            'jumlah'=>$jumlah_pakaian,
            'id_harga' => $harga,
            'tanggal_selesai'=> $tgl_selesai,
            'subtotal'=> $subtotal=$bill*$jumlah_pakaian
        ]);
        $notification = array('title'=> 'Berhasil!','msg'=>'Data transaksi berhasil ditambahkan!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function getTransaksi($id){
        $keranjang = keranjang::where('id', $id)->first();
        $status = "null";
        if($keranjang->harga->jenis_pakaian == null){
            $status = "kiloan";
        }
        else{
            $status = "satuan";
        }
        $data = json_encode([$keranjang, $status]);
        return $data;

        // return $keranjang;
    }

    public function editTransaksi(Request $request){
        $id_keranjang = $request['id_keranjang'];
        $hargakiloan = $request['id_hargakiloan'];
        $hargasatuan = $request['id_hargasatuan'];
        $jumlah = $request['jumlah_pakaian'];
        $berat = $request['berat'];
        $tgl_selesai = $request['tgl_selesai'];       
        $subtotal = 0;

        if($hargakiloan!=null && $berat!=null){
            $harga_kiloan = harga::where('id', $hargakiloan)->first();
            $bill_kiloan = $harga_kiloan->harga;
            keranjang::where('id', $id_keranjang)->update([
                'id_harga' => $hargakiloan,
                'jumlah' => $jumlah,
                'berat' => $berat,
                'tanggal_selesai' => $tgl_selesai,
                'subtotal' => $subtotal = $bill_kiloan*$berat
            ]);
        }
        elseif($hargasatuan!=null && $berat==null){
            $harga_satuan = harga::where('id', $hargasatuan)->first();
            $bill_satuan = $harga_satuan->harga;
            keranjang::where('id', $id_keranjang)->update([
                'id_harga' => $hargasatuan,
                'jumlah' => $jumlah,
                'tanggal_selesai' => $tgl_selesai,
                'subtotal' => $subtotal = $bill_satuan*$jumlah
            ]);
        }
        else {
            $notification = array('title'=> 'Peringatan!','msg'=>'Isi data harga dengan lengkap!','alert-type'=>'warning');
            return redirect()->back()->with($notification);
        }
        $notification = array('title'=> 'Berhasil!','msg'=>'Data transaksi berhasil diubah!','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function deleteTransaksi($id){
        keranjang::where('id',$id)->delete();
        $notification = array('title'=> 'Berhasil!', 'msg'=>'Data transaksi berhasil dihapus!','alert-type'=>'success');
        return redirect('/transaksi')->with($notification);
    }

    public function rekapTransaksi(Request $request){
        $pelanggan = $request['pelanggan'];
        $tgl_masuk = $request['tgl_masuk'];
        $total = $request['total'];

        $rekap = rekap::create([
            'id_pelanggan' => $pelanggan,
            'tanggal_masuk' => $tgl_masuk,
            'total'=> $total,
            'status_laundry' => "proses",
            'bayar'=> 0
        ]);

        foreach ($request->jenis_layanan as $index => $jenis_layanan) {
        transaksi::create([
            'tanggal_masuk' => $tgl_masuk,
            'id_pelanggan' => $pelanggan,
            'jumlah' => $request->jumlah[$index],
            'berat' => $request->berat[$index],
            'id_harga' => $request->harga[$index],
            'subtotal' => $request->subtotal[$index],
            'id_rekap' => $rekap->id,
            'tanggal_selesai'=>$request->tgl_selesai[$index]
        ]);
        }
        keranjang::truncate();
        $notification = array('title'=> 'Berhasil!', 'msg'=>'Data transaksi berhasil dibuat!','alert-type'=>'success');
        return redirect('/pembayaran/'.$rekap->id )->with($notification);
    }
}
