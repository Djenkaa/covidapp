@extends('layouts.app')

@section('title')
    Travel Alert
@endsection

@section('content')

    @php
        $data = session()->get('countryTravel');

    @endphp

    @if($data)
        @include('layouts.headers.guest',['text'=>$data['countryName'],'icon'=>'far fa-newspaper'])

    @else
        @include('layouts.headers.guest',['text'=>__('travelAlert.text'),'icon'=>'far fa-newspaper'])
    @endif


    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-secondary shadow border-0 p-5 text-center">

                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <form action="{{route('travel.news')}}" method="POST">
                                @csrf

                                <label for="">{{__('country.selectCountry')}}</label><br>
                                <select class="form-control" name="selectCountry" id="">
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
                                </select><br>
                                <button type="submit" class="btn btn-primary">{{__('buttons.show')}}</button>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>


        @if(request()->query('show') && $data)

            <div class="row mt-5 mb-5">
                <div class="col-xl-8 offset-xl-2 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col pb-3 clearfix" style="border-bottom: 1px solid rgba(0,0,0,.1);">
                                    <h3 class="mb-0"><i class="fas fa-flag fa-lg"></i> {{$data['countryName']}}
                                        <span style="font-size: 14px;" class="float-right"><i class="fas fa-clock"></i> {{\Carbon\Carbon::parse($data['publishedDate'])->toFormattedDateString()}}
                                    </span>
                                    </h3>
                                </div>
                            </div>
                            <p class="pt-3">{{ $data['alertMessage'] }}</p>

                        </div>
                    </div>
                </div>
            </div>


    </div>




    @endif

    @endsection
