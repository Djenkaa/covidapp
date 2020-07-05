@extends('layouts.app')

@section('title')
    Country Statistics
@endsection


@section('content')

    @php
        $data = session()->get('countryShow');
        $total = session()->get('total');
        $byDate = session()->get('byDate');
    @endphp

    @if($data || $byDate)
        @include('layouts.headers.guest',['text'=>$data['country']?? $byDate['country'],'icon'=>'fas fa-flag'])

    @else
        @include('layouts.headers.guest',['text'=>'Select your country and get statistics about virus','icon'=>'fas fa-flag'])
    @endif



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
                                        <a class="nav-link mb-sm-3 mb-md-0 {{$byDate ? '' : 'active'}}" id="tabs-icons-text-1-tab"
                                           data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                           aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                                class="fas fa-chart-area"></i> General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 {{$byDate ? 'active' : ''}}" id="tabs-icons-text-2-tab" data-toggle="tab"
                                           href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                           aria-selected="false"><i class="fas fa-calendar-alt"></i> Last 7 days</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade {{ $byDate ? '' : 'show active' }}" id="tabs-icons-text-1" role="tabpanel"
                                             aria-labelledby="tabs-icons-text-1-tab">

                                            <form action="{{route('country.get')}}" method="POST">
                                                @csrf

                                                <label for="">Select Country</label><br>
                                                <select class="form-control" name="selectCountry" id="">
                                                    @foreach($countriesList as $country)

                                                        @if($data)
                                                            <option value="{{$country['countryCode']}}"
                                                                {{$country['countryCode'] == $data['countryCode'] ? 'selected' : ''}}
                                                            >
                                                                {{$country['countryName']}}
                                                            </option>
                                                        @else
                                                            <option
                                                                value="{{$country['countryCode']}}">{{$country['countryName']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select><br>
                                                <button type="submit" class="btn btn-primary">Show general</button>

                                            </form>

                                        </div>
                                        <div class="tab-pane fade {{ $byDate ? 'show active' : '' }}" id="tabs-icons-text-2" role="tabpanel"
                                             aria-labelledby="tabs-icons-text-2-tab">

                                            <label for="">Select Country</label><br>
                                            <form action="{{route('country.byDate')}}" method="POST">
                                                @csrf

                                                <select class="form-control" name="countryByDate" id="">

                                                    @foreach($countriesList as $country)

                                                        @if($byDate)
                                                            <option value="{{$country['countryCode']}}"
                                                                {{$country['countryName'] == $byDate['country'] ? 'selected' : ''}}
                                                            >
                                                                {{$country['countryName']}}
                                                            </option>
                                                        @else
                                                            <option
                                                                value="{{$country['countryCode']}}">{{$country['countryName']}}</option>
                                                        @endif

                                                    @endforeach

                                                </select><br>
                                                <button class="btn btn-primary">Show last 7 days</button>

                                            </form>

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
    @if(request()->query('show') && $byDate)


        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-xl-8 mb-5 mb-xl-0">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                    <h2 class="text-white mb-0">Last 7 Days</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chart" id="dailyByDate" data-daily="{{json_encode($byDate)}}">
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
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
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
                                                        class="h2 font-weight-bold mb-0">{{number_format($byDate['totalConfirmed'])}}</span>
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
                                                        class="h2 font-weight-bold mb-0">{{number_format($byDate['totalDeaths'])}}</span>
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
                                                        class="h2 font-weight-bold mb-0">{{number_format($byDate['totalRecovered'])}}</span>
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


       @endif




    @if(request()->query('show') && $data)

        <div class="container-fluid mb-5">
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
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['activeCases'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                <i class="fas fa-user-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageActive = (int)$data['activeCases'] / (int)$total['totalActiveCases'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2"> {{number_format($percentageActive,2)}}%</span>
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
                                                class="h2 font-weight-bold mb-0">{{number_format($data['totalConfirmed'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageConfirmed = (int)$data['totalConfirmed'] / (int)$total['totalConfirmed'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2"> {{number_format($percentageConfirmed,2)}}%</span>
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
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['totalDeaths'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-user-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageDeaths = (int)$data['totalDeaths'] / (int)$total['totalDeaths'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2"> {{number_format($percentageDeaths,2)}}%</span>
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
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['totalRecovered'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageperMill = (int)$data['totalRecovered'] / (int)$total['totalConfirmed'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-success mr-2"> {{number_format($percentageperMill,2)}}%</span>
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
                                    <th scope="row">
                                        {{$data['country']}}
                                    </th>
                                    <td>
                                        {{number_format($data['dailyConfirmed'])}}
                                    </td>
                                    <td>
                                        <i class="text-danger fas fa-arrow-up"></i> {{number_format($data['dailyDeaths'])}}
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-danger mr-3"></i> {{number_format($data['totalConfirmedPerMillionPopulation'])}}
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
                                    <th scope="row">
                                        {{$data['country']}}
                                    </th>
                                    <td>
                                        {{number_format($data['totalConfirmed'])}}
                                    </td>
                                    <td>

                                        @php
                                            $bar = (int) $data['totalConfirmed'] / $total['totalConfirmed'] * 100;
                                        @endphp

                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">{{number_format($bar,2)}}%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                         aria-valuenow="{{$bar}}" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: {{$bar}}%;"></div>
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

    @endif


@endsection
