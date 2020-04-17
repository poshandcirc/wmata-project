<?php

namespace App\Services;

use GuzzleHttp\Client;

class MetroService
{
    public function __construct() {
        $this->client = new Client([
            'headers' => [
                'api_key' => env('METRO_API_KEY')
            ]
        ]);
    }

	public function getStations($line)
	{
	    // Actually getting responses from the API is very simple
        // If you're reading this, you've probably already been like 'why are the responses CamelCaps instead of camelCase?' That's a GREAT question, and the answer is that I'm not doing any translation from metro's api.
        // Anyways, if you're curious enough to be here, maybe mention that you've read this bit because you wanted to understand how the services are working.
        $response = $this->client->get("https://api.wmata.com/Rail.svc/json/jStations?LineCode={$line}");
        $stations = json_decode((string)$response->getBody(), true);
        return $stations['Stations'];
	}

	public function getTimes($line, $station)
	{
		$response = $this->client->get("https://api.wmata.com/StationPrediction.svc/json/GetPrediction/{$station}");
        $stations = json_decode((string)$response->getBody(), true);
        return $stations['Trains'];

	}
}