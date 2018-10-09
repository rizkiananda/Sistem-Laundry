<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class rekap extends Model
{
    protected $table = 'rekap';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'tanggal_masuk','id_pelanggan', 'total', 'status_laundry', 'bayar'
    ];
    public $timestamps = false;

    public function transaksi(){
        return $this-> hasMany('App\Model\transaksi','id_rekap');
    }
    public function pelanggan(){
        return $this-> belongsTo('App\Model\pelanggan','id_pelanggan');
    }
}
