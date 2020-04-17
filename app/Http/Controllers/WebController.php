<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class WebController extends Controller
{
    public function index()
    {
        //
        return view('base');
    }
}
