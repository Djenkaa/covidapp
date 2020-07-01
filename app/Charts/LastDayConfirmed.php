<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LastDayConfirmed extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'custom_chart_name';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'lastDaysConfirmed';

    /**
     * Determines the prefix that will be used by the chart
     * endpoint.
     */
    public ?string $prefix = 'p';

//    /**
//     * Determines the middlewares that will be applied
//     * to the chart endpoint.
//     */
//    public ?array $middlewares = [''];


    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $confirmedLast7Days = [];
        $now = Carbon::today()->toDateTimeLocalString();

        $last7 = Carbon::today()->subDays(7)->toDateTimeLocalString();

        $last7Days = Http::get('https://api.covid19api.com/world',[
            'from'=>$last7,
            'to'=>$now
        ]);
        if($last7Days->successful()){

            foreach ($last7Days->json() as $confirmed){

                array_push($confirmedLast7Days, $confirmed['NewConfirmed']);
            }
        }

        return Chartisan::build()
            ->labels(['Day1', 'Day2', 'Day3', 'Day4', 'Day5', 'Day6', 'Day7'])
            ->dataset('Confirmed', $confirmedLast7Days)
            ->dataset('Sample 2', [3, 2, 1]);

//            ->dataset('Sample 2', [3, 2, 1]);
    }
}
