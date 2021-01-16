<?php

namespace App\Application\Affiliations\Convertiser\Api;

use App\Application\Affiliations\AffiliationAutorizeAbstract;
use GuzzleHttp\Client;

class ConvertiserAuthorization extends AffiliationAutorizeAbstract
{
    /**
     * @var array
     */
    private $convertiser;

    public function __construct(array $convertiser)
    {
        parent::__construct();
        $this->convertiser = $convertiser;
        $this->authorize();
    }

    public function authorize()
    {
        if (!$this->logged) {
            $this->client = new Client([
                'base_uri' => $this->convertiser['base_url'],
                'headers' => [
                    'Authorization' => 'Token ' . $this->convertiser['token']
                ],
            ]);
            $this->logged = true;
        }
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
