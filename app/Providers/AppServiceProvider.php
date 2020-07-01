<?php

namespace App\Providers;

use App\Charts\LastDayConfirmed;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
//        $worldTotalResponse = Http::get('http://api.coronatracker.com/v3/stats/worldometer/global');
//        $worldTotal = [];
//
//        if($worldTotalResponse->successful()){
//
//            $worldTotal = $worldTotalResponse->json();
//        }
//
//        View::composer('layouts.headers.cards', function ($view) use ($worldTotal) {
//
//            $view->with('total', $worldTotal);
//        });
    }
}
