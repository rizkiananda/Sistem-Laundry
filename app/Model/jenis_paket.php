<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jenis_paket extends Model
{
    protected $table = 'jenis_paket';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'nama_paket','status'
    ];
    public $timestamps = false;

    public function harga(){
        return $this-> hasMany('App\Model\harga','id_jenis_paket');
    }

}
