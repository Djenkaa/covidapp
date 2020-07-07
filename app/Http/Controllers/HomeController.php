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
//        $worldTotalResponse = Http::get('http://api.coronatracker.com/v3/stats/worldometer/global');
//        $worldTotal = [];
//
//        if($worldTotalResponse->successful()){
//
//            $worldTotal = $worldTotalResponse->json();
//        }

//        $daily = Http::get('http://api.coronatracker.com/v3/analytics/dailyNewStats?limit=10');
//        $dailyCountry = [];
//        $dailyCases = [];
//
//        if($daily->successful()){
//
//            foreach ($daily->json() as $cases){
//
//                array_unshift($dailyCountry, $cases['country']);
//                array_unshift($dailyCases, $cases['daily_cases']);
//            }
//        }
//        $top5 = Http::get('http://api.coronatracker.com/v3/stats/worldometer/country?limit=5');
//        $top5Confirmed = [];

//        if($top5->successful()){
//
//           foreach ($top5->json() as $top){
//
//               array_push($top5Confirmed, [
//                   'country'=>$top['country'],
//                   'confirmed'=>$top['totalConfirmed'],
//                   'deaths'=>$top['totalDeaths'],
//                   'recovered'=>$top['totalRecovered']
//               ]);
//           }
//        }
//        share(['dailyCountry'=>$dailyCountry, 'dailyCases'=>$dailyCases]);

        return view('dashboard');
    }


    public function country()
    {
//        $countries = Http::get('http://api.coronatracker.com/v2/analytics/country');
//        $countriesList = [];
//
//        if($countries->successful()){
//
//            $countriesList = array_values(Arr::sort($countries->json(), function ($value) {
//                return $value['countryName'];
//            }));
//        }

        return view('country');
    }


//    public function getCountry(Request $request)
//    {
//        $country = $request->selectCountry;
//
//        $show = Http::get("http://api.coronatracker.com/v3/stats/worldometer/country",[
//            'countryCode'=>$country
//        ]);
//        $total = Http::get('http://api.coronatracker.com/v3/stats/worldometer/global');
//
//        $countryShow =[];
//        $totalStat = [];
//
//        if($show->successful() && $total->successful()){
//
//            $countryShow = $show->json()[0];
//            $totalStat = $total->json();
//        }
//
//        return redirect()->route('country',['show'=>'true'])->with(['countryShow'=>$countryShow, 'total'=>$totalStat]);
//    }


    public function travel()
    {
        $countries = Http::get('http://api.coronatracker.com/v2/analytics/country');
        $countriesList = [];

        if($countries->successful()){

            $countriesList = array_values(Arr::sort($countries->json(), function ($value) {
                return $value['countryName'];
            }));
        }

        return view('travelAlert', compact('countriesList'));
    }


    public function support()
    {
        return view('support');
    }


    public function news(Request $request)
    {
        $travel = Http::get('http://api.coronatracker.com/v1/travel-alert');

        $filtered = $this->searchCountry($travel->json(), $request->selectCountry);

        return redirect()->route('travel',['show'=>'true'])->with(['countryTravel'=>$filtered]);
    }


    public function searchCountry($array, $country)
    {
        $search = null;

        foreach ($array as $key=>$value){

            if($value['countryCode'] == $country){
                $search = $value;
                break;
            }
        }
        return $search;
    }


    public function byDate(Request $request)
    {
        $now = Carbon::now()->toDateString();
        $last7Days = Carbon::today()->subDays(7)->toDateString();

        $byDate = Http::get('http://api.coronatracker.com/v3/analytics/newcases/country',[
            'countryCode'=>$request->countryByDate,
            'startDate'=>$last7Days,
            'endDate'=> $now
        ]);
        $stats = [];

        if($byDate->successful()){

        $stats = $this->last7DaysStats($byDate->json());
        }

        return redirect()->route('country',['show'=>'true'])
            ->with(['byDate'=>$stats]);
    }


    private function last7Days($num)
    {
        $dates = [];

        for($i = 0; $i<7; $i++){

            $date = Carbon::today()->subDays($i)->format('D');
            array_push($dates, $date);
        }
        return array_reverse($dates);
    }


    private function last7DaysStats($array)
    {
        $days = $this->last7Days(7);
        $ConfirmedByDate = [];
        $DeathsByDate = [];
        $RecoveredByDate = [];
        $totalRecovered = 0;
        $totalDeaths = 0;
        $totalConfirmed = 0;

        foreach ($array as $case){

            array_push($ConfirmedByDate, $case['new_infections']);
            array_push($DeathsByDate, $case['new_deaths']);
            array_push($RecoveredByDate, $case['new_recovered']);

            $totalConfirmed+=$case['new_infections'];
            $totalDeaths+=$case['new_deaths'];
            $totalRecovered+=$case['new_recovered'];
        }
        $byDate = [
            'days'=>$days,
            'dailyConfirmed'=> $ConfirmedByDate,
            'dailyDeaths'=>$DeathsByDate,
            'dailyRecovered'=>$RecoveredByDate,
            'totalConfirmed'=>$totalConfirmed,
            'totalDeaths'=>$totalDeaths,
            'totalRecovered'=>$totalRecovered,
            'country'=>$array[0]['country']
        ];
        return $byDate;
    }

}
