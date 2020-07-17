<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveController extends Controller
{


    public function dashboard()
    {
        return view('live.dashboard');
    }
}
