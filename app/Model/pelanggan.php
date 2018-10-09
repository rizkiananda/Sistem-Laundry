<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'nama_pelanggan','alamat', 'no_telp'
    ];
    public $timestamps = false;

    public function transaksi(){
        return $this-> hasMany('App\Model\transaksi','id_pelanggan');
    }
    public function rekap(){
        return $this-> hasOne('App\Model\rekap','id_pelanggan');
    }
}
