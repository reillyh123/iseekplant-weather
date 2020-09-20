<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForecastControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testValidForecastCity()
    {
        $response = $this->get('/api/forecast/cairns');
        $response->assertStatus(200);
    }

    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testInvalidForecastCity()
    // {
    //   $response = $this->get('/api/forecast/doesnt-exist');
    //   $response->assertStatus(404);
    // }
}
