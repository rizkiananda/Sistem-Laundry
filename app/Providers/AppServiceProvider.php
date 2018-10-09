<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Model\tipe_kegiatan;
use App\Model\peneliti_psb;
use App\Model\peserta_kegiatan;
use App\Model\peserta_publikasi_jurnal;
use App\Model\peserta_publikasi_buku;
use App\User;
use Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        setlocale(LC_ALL, 'IND');
        Carbon::setLocale('IND');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
