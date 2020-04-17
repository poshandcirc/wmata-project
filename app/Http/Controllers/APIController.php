<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\MetroService;
use App\Services\FakeMetroService;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{
    protected $service;

    public function __construct()
    {
        // Determine if using Real API
        if (env('USE_REAL_API')) {
            $this->service = new MetroService();
        } else {
            $this->service = new FakeMetroService();
        }
    }

    public function index($line)
    {
        try {
            $stations = $this->service->getStations($line);
            return response()->json($stations);
        } catch (\Throwable $exception) {
            return response()->json(['error' => "Error Getting Stations: {$exception->getMessage()}"]);
        }

    }

    public function show($line, $station)
    {
        try {
            $trains = $this->service->getTimes($line, $station);
            return response()->json($trains);
        } catch (\Throwable $exception) {
            return response()->json(['error' => "Error Getting Times: {$exception->getMessage()}"]);
        }
    }
}
