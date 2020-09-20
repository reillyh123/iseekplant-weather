<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ForecastHours as ForecastHoursResource;

class ForecastDays extends ResourceCollection
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
          'date' => date('D M j', strtotime($this['date'])),
          'weather' => ForecastHoursResource::collection($this['weather'])
        ];
    }
}
