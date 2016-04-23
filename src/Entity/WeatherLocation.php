<?php

namespace Drupal\xweather\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\xweather\WeatherLocationInterface;

/**
 * Defines the Weather location entity.
 *
 * @ConfigEntityType(
 *   id = "weather_location",
 *   label = @Translation("Weather location"),
 *   handlers = {
 *     "list_builder" = "Drupal\xweather\WeatherLocationListBuilder",
 *     "form" = {
 *       "add" = "Drupal\xweather\Form\WeatherLocationForm",
 *       "edit" = "Drupal\xweather\Form\WeatherLocationForm",
 *       "delete" = "Drupal\xweather\Form\WeatherLocationDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\xweather\WeatherLocationHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "weather_location",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/weather_location/{weather_location}",
 *     "add-form" = "/admin/structure/weather_location/add",
 *     "edit-form" = "/admin/structure/weather_location/{weather_location}/edit",
 *     "delete-form" = "/admin/structure/weather_location/{weather_location}/delete",
 *     "collection" = "/admin/structure/weather_location"
 *   }
 * )
 */
class WeatherLocation extends ConfigEntityBase implements WeatherLocationInterface {

  /**
   * The Weather location ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Weather location label.
   *
   * @var string
   */
  protected $label;

}
