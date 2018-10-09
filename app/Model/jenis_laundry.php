<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jenis_laundry extends Model
{
    protected $table = 'jenis_laundry';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'nama_jenis'
    ];
    public $timestamps = false;

    public function jenis_layanan(){
        return $this-> hasMany('App\Model\jenis_layanan','id_jenis_laundry');
    }
}
