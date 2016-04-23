<?php

namespace Drupal\xweather\Utils;

use Drupal\Component\Serialization\Json;
use Drupal\xweather\Entity\ForecastRepository;
use Drupal\xweather\Entity\WeatherLocation;

class WeatherManager {

	/**
	 * Get current weather by all locations
	 * @return array
	 */
	public function getNow() {

		$repo = new ForecastRepository();
		$locations = WeatherLocation::loadMultiple();

		$locationsIds = [];

		foreach($locations as $location) {
			$locationsIds[$location->label()] = $location->id();
		}

		$rows = $repo->findByLocation($locationsIds);

		foreach($rows as $key => $row) {

			$rows[$key]->label = array_search($row->location, $locationsIds);
		}

		return $rows;
	}

	/**
	 * Get current weather by all locations as JSON
	 * @return string
	 */
	public function getNowAsJson() {
		return JSON::encode($this->getNow());
	}
}