<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use App\Http\Resources\Forecast as ForecastResource;
use App\Http\Requests\GetForecast;

class ForecastController extends Controller
{
    public function get($city)
    {
      try {
        // just while testing...
        $forecast = json_decode(file_get_contents(storage_path() . '/data.json'), true);

        // $forecast = Http::get('api.openweathermap.org/data/2.5/forecast', [
        //   'q' => $city,
        //   'appid' => env('OPENWEATHER_APP_KEY'),
        //   'units' => 'metric'
        // ]);
        
        $data = new \StdClass();
        $data->info = $forecast['city'];
        foreach ($forecast['list'] as $test) {
          $date = date('d-m-Y', strtotime($test['dt_txt']));
          $data->forecast[$date]['date'] = $date;
          $data->forecast[$date]['weather'][] = collect($test);
        }
        return ForecastResource::make($data);
      } catch (\Exception $e) {
        \Log::info($e);
        abort(404);
      }
    }
}
