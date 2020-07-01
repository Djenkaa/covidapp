<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $worldTotalResponse = Http::get('http://api.coronatracker.com/v3/stats/worldometer/global');
        $worldTotal = [];

        if($worldTotalResponse->successful()){

            $worldTotal = $worldTotalResponse->json();
        }

        $daily = Http::get('http://api.coronatracker.com/v3/analytics/dailyNewStats?limit=10');
        $dailyCountry = [];
        $dailyCases = [];

        if($daily->successful()){

            foreach ($daily->json() as $cases){

                array_unshift($dailyCountry, $cases['country']);
                array_unshift($dailyCases, $cases['daily_cases']);
            }
        }

        $top5 = Http::get('http://api.coronatracker.com/v3/stats/worldometer/country?limit=5');
        $top5Confirmed = [];

        if($top5->successful()){

           foreach ($top5->json() as $top){

               array_push($top5Confirmed, [
                   'country'=>$top['country'],
                   'confirmed'=>$top['totalConfirmed'],
                   'deaths'=>$top['totalDeaths'],
                   'recovered'=>$top['totalRecovered']
               ]);
           }
        }

        share(['dailyCountry'=>$dailyCountry, 'dailyCases'=>$dailyCases]);


        return view('dashboard', compact('worldTotal', 'top5Confirmed'));
    }


    public function country()
    {
        $countries = Http::get('http://api.coronatracker.com/v2/analytics/country');
        $countriesList = [];

        if($countries->successful()){

            $countriesList = $countries->json();
        }

        return view('country', compact('countriesList'));
    }


    public function getCountry(Request $request)
    {
        $country = $request->selectCountry;

        $show = Http::get("http://api.coronatracker.com/v3/stats/worldometer/country",[
            'countryCode'=>$country
        ]);
        $total = Http::get('http://api.coronatracker.com/v3/stats/worldometer/global');

        $countryShow =[];
        $totalStat = [];

        if($show->successful() && $total->successful()){

            $countryShow = $show->json()[0];
            $totalStat = $total->json();
        }

        return redirect()->route('country',['show'=>'true'])->with(['countryShow'=>$countryShow, 'total'=>$totalStat]);
    }


    public function travel()
    {
        return view('travelAlert');
    }


    public function support()
    {
        return view('support');
    }

}
