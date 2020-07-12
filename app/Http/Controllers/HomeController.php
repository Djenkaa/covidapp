<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function country()
    {
        return view('country');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function travel()
    {
        return view('travelAlert');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function support()
    {
        return view('support');
    }



}
