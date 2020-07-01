@extends('layouts.app')


@section('content')
    @include('layouts.headers.guest',['text'=>'Izaberiti vasu drzavu da biste videli razltate'])

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
                                        <option value="{{$country['countryCode']}}">{{$country['countryName']}}</option>
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

    @if(request()->query('show'))

        @php
            $data = session()->get('countryShow');
            $total = session()->get('total');
        @endphp



        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
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
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-success mr-2"> 3.48%</span>
                                        <span class="text-nowrap">of the total</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Daily Confirmed</h5>
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['dailyConfirmed'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-danger mr-2"> 3.48%</span>
                                        <span class="text-nowrap">of the total</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Daily Deaths</h5>
                                            <span
                                                class="h2 font-weight-bold mb-0">{{number_format($data['dailyDeaths'])}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-user-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-warning mr-2"> 1.10%</span>
                                        <span class="text-nowrap">of the total</span>
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
