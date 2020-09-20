<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

class GenerateForecast extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'forecast:generate';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generate a 5 day forecast for each city inputted';

  /**
   * Get the cities to generate 5 day forecast for
   *
   */
  public function handle()
  {
    ini_set('memory_limit', '512M');

    $cities = explode(',', $this->ask('Which cities to retrieve?'));

    $this->info('Fetching forecast...');

    $client = new Client();
    foreach ($cities as $city) {
        $requests[] = new Request('GET', 'http://api.openweathermap.org/data/2.5/forecast?q='.str_replace(' ', '-', trim($city)).'&appid='.env('OPENWEATHER_APP_KEY').'&units=metric');
    }

    $responses = Pool::batch($client, $requests, array(
        'concurrency' => count($cities),
        'fulfilled' => function (Response $response, $index) {
          $response = json_decode($response->getBody());
          $city = $response->city->name;
          $rows = collect($response->list)->map(
            function ($hour) use ($city) {
              return [
                'city' => $city,
                'date' => date('D M j', strtotime($hour->dt_txt)),
                'time' => date('g:i a', strtotime($hour->dt_txt)),
                'temp' => $hour->main->temp,
                'feels like' => $hour->main->feels_like,
                'description' => $hour->weather[0]->description
              ];
            }
          );
          $tableHeads = ['city', 'date', 'time', 'temp', 'feels like', 'description'];
          $this->table($tableHeads, $rows);
        },
        'rejected' => function (RequestException $reason, $index) use ($cities) {
          $this->info('Failed to find data for ' . $cities[$index]);
        }
    ));
    $this->info('Finished!');
  }
}