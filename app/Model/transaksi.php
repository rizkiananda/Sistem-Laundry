<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'tanggal_masuk','id_pelanggan', 'jumlah', 'berat', 'id_harga', 'subtotal', 'id_rekap', 'tanggal_selesai'
    ];
    public $timestamps = false;

    public function harga(){
        return $this-> belongsTo('App\Model\harga','id_harga');
    }

    public function pelanggan(){
        return $this-> belongsTo('App\Model\pelanggan','id_pelanggan');
    }

    public function rekap(){
        return $this-> belongsTo('App\Model\rekap','id_rekap');
    }
}
