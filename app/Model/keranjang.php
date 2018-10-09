<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'jumlah','berat', 'id_harga', 'subtotal', 'tanggal_selesai'
    ];
    public $timestamps = false;

    public function harga(){
        return $this-> belongsTo('App\Model\harga','id_harga');
    }

}
