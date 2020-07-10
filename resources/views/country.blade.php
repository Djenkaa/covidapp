@extends('layouts.app')

@section('title')
    Country Statistics
@endsection


@section('content')

        @include('layouts.headers.guest',['text'=>'Select your country and get statistics about virus','icon'=>'fas fa-flag'])


    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-secondary p-4 shadow border-0 text-center">

                    <div class="row">
                        <div class="col-md-12">

                            {{--               NAVS             --}}
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab"
                                           data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                           aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                                class="fas fa-chart-area"></i> General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                           href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                           aria-selected="false"><i class="fas fa-calendar-alt"></i> Last 7 days</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                             aria-labelledby="tabs-icons-text-1-tab">

                                            <div class="loader countriesLoader" style="color: #5e72e4;"></div>
                                            <div class="loader countryStatsLoader" style="color: #5e72e4;display: none;"></div>

                                                <div class="countries" style="display: none;">

                                                <label for="">Select Country</label><br>
                                                <select class="form-control" name="selectCountry" id="">

                                                </select><br>
                                                <button id="showGeneral" class="btn btn-primary">Show general</button>

                                                </div>


                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                             aria-labelledby="tabs-icons-text-2-tab">

                                            <div class="loader countriesLoader" style="color: #5e72e4;"></div>
                                            <div class="loader countryStatsLoader" style="color: #5e72e4;display: none;"></div>

                                            <div class="countries" style="display: none;">

                                            <label for="">Select Country</label><br>

                                                <select class="form-control" name="countryByDate" id="">

                                                </select><br>
                                                <button id="showLast7Days" class="btn btn-primary">Show last 7 days</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{--  CHARTS  --}}



        <div class="container-fluid" id="countryLast7Days" style="display: none;">
            <div class="row mb-5">
                <div class="col-xl-8 mb-5 mb-xl-0">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase mb-1 text-light myFloatRight"><i class="far fa-clock fa-lg"></i> Updated at <span class="countryLast7Update">...</span></h6>
                                    <h2 class="text-white mb-0">Last 7 Days</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chart" id="dailyByDate">
                                <!-- Chart wrapper -->
                                <canvas id="daily" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase mb-1 text-muted"><i class="far fa-clock fa-lg"></i> Updated at <span class="countryLast7Update">...</span></h6>
                                    <h2 class="mb-0">Total result in last 7 days</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
{{--                            <div class="chart">--}}
{{--                                <canvas id="oprem" class="chart-canvas"></canvas>--}}
{{--                            </div>--}}



                            <div class="row">
                                <div class="col-xl-12 col-lg-12 mt-4">
                                    <div class="card card-stats mb-4 mb-xl-0 shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Confirmed Cases </h5>
                                                    <span
                                                        class="h2 font-weight-bold mb-0" id="countryConfirmed7"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                        <i class="fas fa-user-check"></i>
                                                    </div>
                                                </div>
                                            </div>

{{--                                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                                <span class="text-warning mr-2"> 54354%</span>--}}
{{--                                                <span class="text-nowrap">total of the world</span>--}}
{{--                                            </p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 mt-4">
                                    <div class="card card-stats mb-4 mb-xl-0 shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Deaths Cases</h5>
                                                    <span
                                                        class="h2 font-weight-bold mb-0" id="countryDeaths7"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                        <i class="fas fa-user-times"></i>
                                                    </div>
                                                </div>
                                            </div>

{{--                                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                                <span class="text-danger mr-2"> 54354%</span>--}}
{{--                                                <span class="text-nowrap">total of the world</span>--}}
{{--                                            </p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 mt-4">
                                    <div class="card card-stats mb-4 mb-xl-0 shadow">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Recovered Cases</h5>
                                                    <span
                                                        class="h2 font-weight-bold mb-0" id="countryRecovered7"></span>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                        <i class="fas fa-user-shield"></i>
                                                    </div>
                                                </div>
                                            </div>

{{--                                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                                <span class="text-danger mr-2"> 54354%</span>--}}
{{--                                                <span class="text-nowrap">total of the world</span>--}}
{{--                                            </p>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="container-fluid mb-5" id="countryStats" style="display: none;">
        <div class="header bg-gradient-primary pb-5 pt-5 shadow">
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Active Cases</h5>
                                            <span id="countryActive"
                                                class="h2 font-weight-bold mb-0"></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                <i class="fas fa-user-lock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2" id="activePerc"> %</span>
                                        <span class="text-nowrap">total of the world</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total Confirmed</h5>
                                            <span
                                                class="h2 font-weight-bold mb-0 countryConfirmed"></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2" id="confirmedPerc"> %</span>
                                        <span class="text-nowrap">total of the world</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total Deaths</h5>
                                            <span id="countryDeaths"
                                                class="h2 font-weight-bold mb-0"></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-user-times"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2" id="deathsPerc"> %</span>
                                        <span class="text-nowrap">total of the world</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total Recovered</h5>
                                            <span id="countryRecovered"
                                                class="h2 font-weight-bold mb-0"></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-success mr-2" id="recoveredPerc"> %</span>
                                        <span class="text-nowrap">total of the world</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>





            <div class="row mt-5">
                <div class="col-xl-8 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase mb-1 text-muted myFloatRight"><i class="far fa-clock fa-lg"></i> Updated at <span class="globalTopUpdate">...</span></h6>
                                    <h3 class="mb-0">Today statistics</h3>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Country</th>
                                    <th scope="col">Confirmed</th>
                                    <th scope="col">Deaths</th>
                                    <th scope="col">Confirmed per mill</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <th scope="row" class="countryName">

                                    </th>
                                    <td id="countryConfirmedToday">

                                    </td>
                                    <td>
                                        <i class="text-danger fas fa-arrow-up"></i> <span id="countryDeathsToday"></span>
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-danger mr-3"></i> <span id="countryConfirmedPerMill"></span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase mb-1 text-muted myFloatRight"><i class="far fa-clock fa-lg"></i> Updated at <span class="globalTopUpdate">...</span></h6>

                                    <h3 class="mb-0">Confirmed</h3>
                                </div>
                                {{--                            <div class="col text-right">--}}
                                {{--                                <a href="#!" class="btn btn-sm btn-primary">See all</a>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Country</th>
                                    <th scope="col">Confirmed</th>
                                    <th scope="col">of the Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <th scope="row" class="countryName">

                                    </th>
                                    <td class="countryConfirmed">

                                    </td>
                                    <td>

                                        <div class="d-flex align-items-center">
                                            <span class="mr-2" id="countryPercentage">%</span>
                                            <div>
                                                <div class="progress">
                                                    <div id="countryConfirmedBar" class="progress-bar bg-gradient-danger" role="progressbar"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


@endsection
