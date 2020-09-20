<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Exception\RequestException;

class ForecastApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testForecastApiResponse()
    {
      $responseData = json_decode(file_get_contents(storage_path() . '/json-response.json'), true);

      $statusCode = 200;

      $this->createMockResponse($responseData, $statusCode);

      $response = $this->get('/forecast/cairns');

      // cannot figure out how to assert the json response of this controller/Http request to api
      // $this->assertTrue($response == $responseData);
      $this->assertTrue($response->getStatusCode() == $statusCode);
    }

    private function createMockResponse($responseData, $statusCode)
    {
      $headers = ['Content-Type' => 'application/json'];
      $body = json_encode($responseData);

      $response = new Response($statusCode, $headers, $body);

      $mock = new MockHandler([
          $response
      ]);

      $handler = HandlerStack::create($mock);
      $client = new Client(['handler' => $handler]);

      //client instance is bound to the mock here.
      $this->app->instance(Client::class, $client); 

      return $response;
  }
}
