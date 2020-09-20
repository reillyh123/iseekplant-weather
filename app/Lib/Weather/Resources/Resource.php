<?php

namespace App\Lib\Weather\Resources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

/**
 * The Resource wraps the Guzzle functionality to communicate with the remote server,
 * and handles mapping the responses to Modal objects.
 */
abstract class Resource
{
    /** @var \GuzzleHttp\Client $client */
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Send a request
     * @todo Add Caching.
     * @param string $method the name of the remote method
     */
    public function sendRequest($url, $opts = [])
    {
        try {
            $response = $this->client->call($url, $opts);
            return $response;
        } catch (ClientException $e) {
            $this->handleExceptions($e);
        } catch (RequestException $e) {
            $this->handleExceptions($e);
        }
    }

    /**
     * Translate a single item into a Modal.
     * @param array $data
     * @param string $class
     * @return mixed
     */
    protected function mapToModal($data, $class)
    {
        return new $class($data);
    }

    /**
     * Creates a collection of Modal classes from an array of response data.
     * @param array $data typically the response from the API
     * @param string $class the Modal that you want to create
     * @return array a collection of the Modals instantiated
     */
    protected function mapToCollection($data, $class)
    {
        return collect($data)
            ->map(function ($result) use ($class) {
                return new $class($result);
            })
            ->toArray();
    }

    /**
     * @todo log these, or send them to newrelic/datadog or something.
     * @param RequestException $e
     */
    public function handleExceptions(RequestException $e)
    {
        die('Exception!! ' . $e->getMessage());
    }
}
