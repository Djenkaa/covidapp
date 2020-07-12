@extends('layouts.app')

@section('title')
    Support
@endsection

@section('content')
    @include('layouts.headers.guest', ['text'=>__('support.text'),'icon'=>'fab fa-cc-paypal'])

    <div class="container mt--6 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-secondary shadow border-0 p-5 text-center">

                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <a href="https://paypal.me/GedeonRS">
                                <button class="btn btn-warning btn-lg">
                                    <i class="fab fa-paypal"></i> {{__('buttons.support')}}
                                </button>
                            </a>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
