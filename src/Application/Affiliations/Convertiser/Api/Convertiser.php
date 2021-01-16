<?php

namespace App\Application\Affiliations\Convertiser\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

abstract class Convertiser
{
    /**
     * @var Client $client
     */
    private $client;

    public function __construct(ConvertiserAuthorization $convertiserAuthorization)
    {
        $this->client = $convertiserAuthorization->getClient();
    }

    protected function getResponse(array $data = [])
    {
        $response = null;
        $url = $data['url'] ?? $this->getUrl();
        try {
            $response = $this->client->get($url);

        } catch (RequestException $requestException) {
            $response = $requestException->getResponse();
        }

        return json_decode($response->getBody()->getContents(), true) ?: [];
    }

    abstract protected function getUrl(): string;

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
