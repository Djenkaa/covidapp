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



    <travel-alert inline-template>

        <div class="container mt--8 pb-5" v-cloak>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="card bg-secondary shadow border-0 p-5 text-center">

                        <div class="row">
                            <div class="col-md-6 offset-md-3">

                                <div v-if="loader" class="loader" style="color: #5e72e4;"></div>

                                <div v-else>
                                <label>{{__('country.selectCountry')}}</label><br>
                                <select class="form-control" name="travelAlert" v-model="countrySelected">

                                    <option v-for="country in countries" :value="country.countryCode">
                                        @{{ country.countryName }}
                                    </option>

                                </select><br>
                                <button @click="getTravelAlert" class="btn btn-primary">{{__('buttons.show')}}</button>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>




                <div v-if="countryAlert" class="row mt-5 mb-5">
                    <div class="col-xl-8 offset-xl-2 mb-5 mb-xl-0">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col pb-3 clearfix" style="border-bottom: 1px solid rgba(0,0,0,.1);">
                                        <h3 class="mb-0"><i class="fas fa-flag fa-lg"></i> @{{ countryAlert.countryName }}
                                            <span style="font-size: 14px;" class="float-right"><i
                                                    class="fas fa-clock"></i> @{{ countryAlert.publishedDate }}
                                    </span>
                                        </h3>
                                    </div>
                                </div>
                                <p class="pt-3">@{{ countryAlert.alertMessage }}</p>

                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </travel-alert>





@endsection
