<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ForecastDays as ForecastDaysResource;

class Forecast extends JsonResource
{

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
      $forecast = [
        'city' => $this->info['name'],
        'city_id' => $this->info['id'],
        'forecast' => ForecastDaysResource::collection($this->forecast)
      ];

      \Log::info(json_encode($forecast));

      return $forecast;
  }
}
