<?php

namespace Drupal\xweather\Utils;

use Drupal\Component\Serialization\Json;

class WeatherExtractor {

	const API_URL = 'http://api.openweathermap.org/data/2.5/forecast?';

	private $key;

	public function __construct()
	{
		$this->key = \Drupal::config('xweather.settings')->get('settings.api_key');
	}

	public function url($locationId)
	{
		return self::API_URL . http_build_query([
		  'APPID'=> $this->key,
		  'units'=> 'metric',
		  'id' => $locationId
		]);
	}

	public function generate(array $locations) {

		foreach($locations as $location) {

			try {

				$response = \Drupal::httpClient()->get($this->url($location->id()));

				if($response->getStatusCode() >= 400) {
					throw new \Exception('Cannot get response for location: ' . $location->label() . ' because of ' . $response->getStatusCode());
				}

				$forecasts = Json::decode($response->getBody()->getContents())['list'];

				foreach($forecasts as $forecast) {

					yield [
					  'location' => $location->id(),
					  'temperature' => $forecast['main']['temp'],
					  'humidity' => $forecast['main']['humidity'],
					  'description' => reset($forecast['weather'])['main'],
					  'date' => $forecast['dt'],
					];
				}

			} catch (\Exception $e){
				\Drupal::logger('xcono_weather')->error($e->getMessage());
			}
		}

	}
}