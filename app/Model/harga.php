<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class harga extends Model
{
    protected $table = 'harga';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'id_jenis_pakaian', 'id_jenis_layanan', 'id_jenis_paket','harga', 'status'
    ];
    public $timestamps = false;

    public function jenis_layanan(){
        return $this-> belongsTo('App\Model\jenis_layanan','id_jenis_layanan');
    }
    public function jenis_pakaian(){
        return $this-> belongsTo('App\Model\jenis_pakaian','id_jenis_pakaian');
    }
    public function jenis_paket(){
        return $this-> belongsTo('App\Model\jenis_paket','id_jenis_paket');
    }
    public function keranjang(){
        return $this-> hasOne('App\Model\keranjang','id_harga');
    }
    public function transaksi(){
        return $this-> hasOne('App\Model\transaksi','id_harga');
    }
}
