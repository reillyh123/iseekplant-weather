<?php

namespace App\Lib\Weather\Resources;

use App\Lib\Weather\Models\Booking;

class Forecast extends Resource
{
  public function getForecast($city)
  {
    $forecast = $this->sendRequest("/data/2.5/forecast", [
      'query' => [
          'q' => $city,
          'appid' => env('OPENWEATHER_APP_KEY')
      ]
    ]);
    
    return $forecast;
  }
}