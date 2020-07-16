@extends('live.layouts.live')

@section('title')

    Live Statistics

@endsection


@section('content')


    {{--  CARDS  --}}

    <div class="row mt-4">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{__('appTerms.total')}} {{__('appTerms.confirmed')}}</h5>
                            <span id="liveTotalConfirmed" class="h2 font-weight-bold mb-0">
                                       {{__('appTerms.loading')}} ...
                                    </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{__('appTerms.total')}} {{__('appTerms.deaths')}}</h5>
                            <span id="liveTotalDeaths"
                                  class="h2 font-weight-bold mb-0">{{__('appTerms.loading')}} ...</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-user-times"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{__('appTerms.total')}} {{__('appTerms.recovered')}}</h5>
                            <span id="liveTotalRecovered" class="h2 font-weight-bold mb-0">{{__('appTerms.loading')}} ...</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{__('appTerms.active')}} {{__('appTerms.cases')}}</h5>
                            <span id="liveTotalActive"
                                  class="h2 font-weight-bold mb-0">{{__('appTerms.loading')}} ...</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                <i class="fas fa-user-lock"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--  ENDCARDS  --}}


    {{--  CHARTS  --}}

    <div class="row mt-4">
        <div class="col-xl-8 mb-5 mb-xl-0" style="display: none;">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Sales value</h2>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x"></i>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="live-chart" class="chart-canvas"></canvas>
                    </div>

                </div>
            </div>


            <div class="card bg-gradient-default shadow mt-4">
                <div class="card-header bg-transparent pb-0">
                    <div class="row align-items-center">
                        <div class="col">
                            {{--                        <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>--}}
                            <h2 class="text-white mb-0">The most critical country</h2>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>

                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">

                        <div>
                            <table class="table align-items-center table-dark">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort text-light font-weight-bold" data-sort="name">Country
                                    </th>
                                    <th scope="col" class="sort text-light font-weight-bold" data-sort="budget">
                                        Confirmed today
                                    </th>
                                    <th scope="col" class="sort text-light font-weight-bold" data-sort="status">Deaths
                                        today
                                    </th>
                                    <th scope="col" class="sort text-light font-weight-bold">Total Confirmed</th>
                                    <th scope="col" class="sort text-light font-weight-bold" data-sort="completion">
                                        Total Deaths
                                    </th>
                                    <th scope="col" class="sort text-light font-weight-bold" data-sort="completion">
                                        Total Recovered
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list" id="theWorstCountry">


                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Top 7 the most vulnerable countries today</h2>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x"></i>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">


                            <div>
                                <table class="table align-items-center table-dark">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="sort text-light font-weight-bold" data-sort="name">
                                            Country
                                        </th>
                                        <th scope="col" class="sort text-light font-weight-bold" data-sort="budget">
                                            Confirmed today
                                        </th>
                                        <th scope="col" class="sort text-light font-weight-bold" data-sort="status">
                                            Deaths today
                                        </th>
                                        <th scope="col" class="sort text-light font-weight-bold" data-sort="completion">
                                            Total Confirmed
                                        </th>
                                        <th scope="col" class="sort text-light font-weight-bold" data-sort="completion">
                                            Total Deaths
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody id="theWorstCountries" class="list">

{{--                                    <tr>--}}
{{--                                        <th scope="row">--}}
{{--                                            <div class="media align-items-center">--}}

{{--                                                <img src="https://www.countryflags.io/be/shiny/48.png">--}}
{{--                                                <span class="name mb-0 text-sm"> Drzava</span>--}}

{{--                                            </div>--}}
{{--                                        </th>--}}
{{--                                        <td class="budget">--}}
{{--                                            $2500 USD--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            543653--}}
{{--                                        </td>--}}

{{--                                        <td>--}}
{{--                                            <div class="d-flex align-items-center">--}}
{{--                                                <span class="completion mr-2">60%</span>--}}
{{--                                                <div>--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar bg-warning" role="progressbar"--}}
{{--                                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"--}}
{{--                                                             style="width: 60%;"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <span class="ml-2"> <i class="fas fa-globe-americas fa-lg"></i></span>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="d-flex align-items-center">--}}
{{--                                                <span class="completion mr-2">60%</span>--}}
{{--                                                <div>--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar bg-warning" role="progressbar"--}}
{{--                                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"--}}
{{--                                                             style="width: 60%;"></div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <span class="ml-2"> <i class="fas fa-globe-americas fa-lg"></i></span>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}

{{--                                    </tr>--}}


                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="card-title mb-0">
                                All Countries
                            </h2>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-globe-americas fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="tableFixHead">
                        <!-- Projects table -->
                        <div id="countryHolder">

                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{__('appTerms.country')}}</th>
                                    <th scope="col">{{__('appTerms.confirmed')}}</th>
                                    <th scope="col">{{__('appTerms.deaths')}}</th>
                                    <th scope="col">{{__('appTerms.recovered')}}</th>
                                </tr>
                                </thead>
                                <tbody id="listOfCoutrnies">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-stats mb-4 mb-xl-0 shadow-sm mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <h5 class="card-title text-uppercase mb-0">The most successful country</h5>
                            <span id="successfulCountryName" class="h2 font-weight-bold mb-0 text-muted">
                           <img src="https://www.countryflags.io/be/shiny/48.png"> Gvineja
                        </span>
                        </div>
                        <div class="col-lg-3 text-center">
                            <h5 class="card-title text-uppercase mb-0">Confirmed</h5>

                            <h1 id="successfulCountryConfirmed">0</h1>
                        </div>
                        <div class="col-lg-2 text-right">

                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="fas fa-trophy"></i>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{--  ENDCHARTS  --}}


    {{--  TABLES  --}}

    <div class="row">

        <div class="col-xl-8 mb-5 mb-xl-0 mt--4 ">


        </div>


        <div class="col-xl-4 mt-4">


        </div>
    </div>

    {{--  ENDTABLES  --}}


@endsection
