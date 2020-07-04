@extends('layouts.app')

@section('title')
    Support
@endsection

@section('content')
    @include('layouts.headers.guest', ['text'=>'We love building products that help the community, so please support if you can!','icon'=>''])

    <div class="container mt--6 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card bg-secondary shadow border-0 p-5 text-center">

                    <div class="row">
                        <div class="col-md-6 offset-md-3">

                            <a href="https://paypal.me/GedeonRS">
                                <button class="btn btn-warning btn-lg">
                                    <i class="fab fa-paypal"></i> Support
                                </button>
                            </a>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
