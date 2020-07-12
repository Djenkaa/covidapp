@extends('layouts.app')

@section('title')
    Global Statistics
    @endsection

@section('content')
    @include('layouts.headers.cards')

    <div id="allCountries" data-allcountries="{{json_encode(__('countries.countries'))}}"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light mb-1 myFloatRight"><i class="far fa-clock fa-lg"></i>
                                    {{__('appTerms.updated')}} <span class="globalChartUpdate">...</span></h6>
                                <h2 class="text-white mb-0">{{__('global.dailyCases')}} </h2>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Chart -->

                        <div class="chart">
                            <div id="dailyTop10Loader" data-text="{{__('global.chartText')}}" class="loader"
                                 data-confirmed="{{__('appTerms.confirmed')}}"
                                 data-deaths="{{__('appTerms.deaths')}}"
                                 data-countries="{{json_encode(__('countries.countries'))}}"
                            ></div>
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
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
                                <h6 class="text-uppercase mb-1 text-muted myFloatRight"><i class="far fa-clock fa-lg"></i>
                                    {{__('appTerms.updated')}} <span class="globalTopUpdate">...</span></h6>
                                <h3 class="mb-0">{{__('global.mostVulnerable')}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{__('appTerms.country')}}</th>
                                    <th scope="col">{{__('appTerms.confirmed')}}</th>
                                    <th scope="col">{{__('appTerms.deaths')}}</th>
                                    <th scope="col">{{__('appTerms.recovered')}}</th>
                                </tr>
                            </thead>
                            <tbody id="mostVulnerableCountries">

                                <div id="mostVulnerableCountriesLoader" class="loader" style="color: #5e72e4"></div>

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
                                <h6 class="text-uppercase mb-1 text-muted"><i class="far fa-clock fa-lg"></i> {{__('appTerms.updated')}} <span class="globalTopUpdate">...</span></h6>
                                <h3 class="mb-0">{{__('global.top5Confirmed')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{__('appTerms.country')}}</th>
                                    <th scope="col">{{__('appTerms.confirmed')}}</th>
                                    <th scope="col">{{__('global.ofTotal')}}</th>
                                </tr>
                            </thead>
                            <tbody id="top5Confirmed">

                            <div class="loader" id="top5ConfirmedLoader" style="color: #5e72e4"></div>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection


