<?php
namespace Drupal\xweather\Entity;


class ForecastRepository {

	const DB_TABLE = 'xweather_forecast';

	protected $database;

	/**
	 * ForecastRepository constructor.
	 */
	public function __construct() {
		$this->database = \Drupal::database();
	}

	/**
	 * Find nearest by time forecasts
	 * @param array $locations
	 * @return mixed
	 */
	public function findByLocation(array $locations) {

		return $rows = $this->database
		  ->select(self::DB_TABLE, 'w')
		  ->fields('w', [])
		  ->condition('location', $locations, 'IN')
		  ->condition('date', REQUEST_TIME, '>')
		  ->orderBy('date')
		  ->range(0, count($locations))
		  ->execute()
		  ->fetchAll();

	}

	/**
	 * Get all forecasts
	 * @return mixed
	 */
	public function findByAll() {

		return $rows = $this->database
		  ->select(self::DB_TABLE, 'w')
		  ->fields('w', [])
		  ->orderBy('date')
		  ->execute()
		  ->fetchAll();

	}

	/**
	 * Insert new forecast
	 * @param array $fields
	 * @return \Drupal\Core\Database\StatementInterface|int|null
	 * @throws \Exception
	 */
	public function create(array $fields)
	{
		return $this->database
		  ->insert(self::DB_TABLE)
		  ->fields($fields)
		  ->execute();

	}

	/**
	 * Remove forecasts by location
	 * @param $location
	 * @return int
	 */
	public function removeByLocation($location)
	{
		return $this->database
		  ->delete(self::DB_TABLE)
		  ->condition('location', $location)
		  ->execute();
	}

	/**
	 * Remove forecasts by location
	 * @return int
	 * @internal param $location
	 */
	public function removeAll()
	{
		return $this->database
		  ->delete(self::DB_TABLE)
		  ->execute();
	}
}