<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ForecastHours extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'time' => date('g:i a', strtotime($this['dt_txt'])),
          'temp' => $this['main']['temp'],
          'feels_like' => $this['main']['feels_like'],
          'description' => $this['weather'][0]['main'],
          'icon_id' => $this['weather'][0]['icon'],
        ];
    }
}
