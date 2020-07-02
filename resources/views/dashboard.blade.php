@extends('layouts.app')

@section('title')
    Global Statistics
    @endsection

@section('content')
    @include('layouts.headers.cards',['total'=>$worldTotal])


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Daily Confirmed Cases</h2>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
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
                                <h3 class="mb-0">The most vulnerable countries</h3>
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
                            @foreach($top5Confirmed as $country)
                                <tr>
                                    <th scope="row">
                                        {{$country['country']}}
                                    </th>
                                    <td>
                                        {{number_format($country['confirmed'])}}
                                    </td>
                                    <td>
                                        <i class="text-danger fas fa-arrow-down"></i> {{number_format($country['deaths'])}}
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> {{number_format($country['recovered'])}}
                                    </td>
                                </tr>
                                @endforeach

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
                                <h3 class="mb-0">Top 5 countries by confirmed cases</h3>
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

                            @foreach($top5Confirmed as $top)
                                <tr>
                                    <th scope="row">
                                        {{$top['country']}}
                                    </th>
                                    <td>
                                        {{number_format($top['confirmed'])}}
                                    </td>
                                    <td>
                                        @php
                                        $bar = (int)$top['confirmed'] / (int)$worldTotal['totalConfirmed'] * 100;
                                        @endphp
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">{{number_format($bar,2)}}%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="{{$bar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$bar}}%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection


