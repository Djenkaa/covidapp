@extends('layouts.app')

@section('title')
    Country Statistics
@endsection


@section('content')

    @php
        $data = session()->get('countryShow');
        $total = session()->get('total');
    @endphp

    @if($data)
        @include('layouts.headers.guest',['text'=>$data['country'],'icon'=>'fas fa-flag'])

    @else
        @include('layouts.headers.guest',['text'=>'Select your country and get statistics about virus','icon'=>''])
    @endif



    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-secondary shadow border-0 p-5 text-center">

                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <form action="{{route('country.get')}}" method="POST">
                                @csrf

                                <label for="">Select Country</label><br>
                                <select name="selectCountry" id="">
                                    @foreach($countriesList as $country)

                                        @if($data)
                                            <option value="{{$country['countryCode']}}"
                                                {{$country['countryCode'] == $data['countryCode'] ? 'selected' : ''}}
                                            >
                                                {{$country['countryName']}}
                                            </option>
                                        @else
                                            <option value="{{$country['countryCode']}}">{{$country['countryName']}}</option>
                                        @endif
                                    @endforeach
                                </select><br><br>
                                <button type="submit" class="btn btn-primary">Show</button>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @if(request()->query('show') && $data)

        <div class="header bg-gradient-primary pb-5 pt-5 ">
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
                                        <span class="text-{{$percentageActive < 1 ? 'success' : 'danger'}} mr-2"> {{number_format($percentageActive,2)}}%</span>
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
                                            <h5 class="card-title text-uppercase text-muted mb-0">Confirmed Today</h5>
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['dailyConfirmed'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageConfirmed = (int)$data['dailyConfirmed'] / (int)$data['totalConfirmed'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-{{$percentageConfirmed < 1 ? 'success' : 'danger'}} mr-2"> {{number_format($percentageConfirmed,2)}}%</span>
                                        <span class="text-nowrap">total of {{$data['country']}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Deaths Today</h5>
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['dailyDeaths'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-user-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageDeaths = (int)$data['dailyDeaths'] / (int)$data['totalDeaths'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-{{$percentageDeaths < 1 ? 'success' : 'danger'}} mr-2"> {{number_format($percentageDeaths,2)}}%</span>
                                        <span class="text-nowrap">total of {{$data['country']}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Confirmed per million</h5>
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['totalConfirmedPerMillionPopulation'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $percentageperMill = (int)$data['totalConfirmedPerMillionPopulation'] / (int)$data['totalConfirmed'] * 100;
                                    @endphp
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-{{$percentageperMill < 1 ? 'success' : 'danger'}} mr-2"> {{number_format($percentageperMill,2)}}%</span>
                                        <span class="text-nowrap">total of {{$data['country']}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




        <div class="container-fluid mt-3 mb-5">
            <div class="row mt-5">
                <div class="col-xl-8 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Total stats</h3>
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
                                    <th scope="col">Recovered</th>
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
                                        <i class="text-danger fas fa-arrow-down"></i> {{number_format($data['totalDeaths'])}}
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> {{number_format($data['totalRecovered'])}}
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
