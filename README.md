# Weather forecast module manager for Drupal 8

Module fetch weather forecast from api.openweathermap.org. The module is simple and get only limited set of data from rich response of OpenWeatherMap.
The data saves in database table, which cleared every time before update.

# Data

- location
- temperature
- humidity
- forecast time (timestamp)
- description (text description of weather: clear, rain, etc., could be used for icon classes or labels)

# GUI for settings

The module provides GUI only for settings and simple CRUD for setting locations. Every location has label and id (http://openweathermap.org/help/city_list.txt)

# Only manager and repository

```bash
$wm = \Drupal::service('xweather.manager');
$data = $weather_manager->getNow();
```
Results to:
```bash
array [

  'object stdClass':
    - id: string "258"
    - location: string "1151254"
    - temperature: string "29.17"
    - humidity: string "100"
    - description: string "Clear"
    - date -> string "1461445200"
    - label -> string "Phuket, Thailand"
]
```
Or as Json:
```bash
$wm = \Drupal::service('xweather.manager');
$data = $weather_manager->getNowAsJson();
```