<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jenis_pakaian extends Model
{
    protected $table = 'jenis_pakaian';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'nama_pakaian','status'
    ];
    public $timestamps = false;

    public function harga(){
        return $this-> hasMany('App\Model\harga','id_jenis_pakaian');
    }

}
