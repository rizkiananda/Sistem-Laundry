<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jenis_layanan extends Model
{
    protected $table = 'jenis_layanan';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'id_jenis_laundry', 'nama_layanan', 'status'
    ];
    public $timestamps = false;

    public function jenis_laundry(){
        return $this-> belongsTo('App\Model\jenis_laundry','id_jenis_laundry');
    }
    public function harga(){
        return $this-> hasMany('App\Model\harga','id_jenis_layanan');
    }
}
