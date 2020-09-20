<?php

namespace App\Lib\Weather;

use GuzzleHttp\Client as GuzzleClient;
use App\Lib\Weather\Resources\Forecast;

class Client
{
  protected $client;

  public function __construct()
  {
    if ($this->client === null) {
      $this->client = $this->create();
    }
  }

  protected function create()
  {
    $this->client = new GuzzleClient([
      'base_uri' => env('OPENWEATHER_APP_URI')
    ]);
    return $this->client;
  }

  public function forecast()
  {
    return new Forecast($this->client);
  }

}