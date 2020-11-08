<?php
namespace App\Application\Affiliations\Webepartners\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

abstract class Webepartners
{
    /**
     * @var Client $client
     */
    private $client;

    public function __construct(WebepartnersAuthorization $webepartnersAuthorization)
    {
        $this->client = $webepartnersAuthorization->getClient();
    }
    abstract protected function getUrl() : string;

    protected function getResponse(array $query = [])
    {
        $response = null;
        try {
            $response = $this->client->get($this->getUrl(), [
                'query' => $query,
            ]);
        } catch (RequestException $requestException) {
            $response = $requestException->getResponse();
        }

        return json_decode($response->getBody()->getContents(), true)  ?: [];
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
