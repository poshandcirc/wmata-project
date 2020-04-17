<?php

namespace App\Services;

use GuzzleHttp\Client;

class FakeMetroService
{
    protected $lines;
    protected $stations;

    public function __construct() {
        $contents = file_get_contents(__DIR__.'/FakeData/stations.json');
        $this->lines = json_decode($contents, true);
        $unfilteredStations = file_get_contents(__DIR__.'/FakeData/unfiltered_stations.json');
        $this->stations = collect(json_decode($unfilteredStations, true));
    }

	public function getStations($line)
	{
        return $this->lines[$line];
	}

    public function getTimes($line, $station)
    {
        // The metro api returns the string 'BRD' instead of an integer for number of minutes if it's 0. Please let us know if you're poking around here in your interview!
        $collectedLine = collect($this->lines[$line]);
        $numIncomingTrains = rand(1, 10);
        $results = [];
        for ($i = 0; $i < $numIncomingTrains; $i++) {
            $destination = $collectedLine->random();
            $carsInTrain = rand(6, 8);
            $group = rand(1, 2);
            $mins = rand(1, 30);
            $location = $this->stations->firstWhere('Code', $station);
            $results[] = [
                'Car' => $carsInTrain,
                'DestinationCode' => $destination['Code'],
                'DestinationName' => $destination['Name'],
                'Group' => $group,
                'Line' => $line,
                'LocationCode' => $location['Code'],
                'LocationName' => $location['Name'],
                'Min' => $mins
            ];
        }
        $results = collect($results);
        return $results->sortBy('Min')->values()->all();
    }
}