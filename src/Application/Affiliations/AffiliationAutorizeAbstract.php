<?php


namespace App\Application\Affiliations;

use GuzzleHttp\Client;

abstract class AffiliationAutorizeAbstract
{
    /**
     * @var Client $client
     */
    protected $client;
    protected bool $logged = false;


    public function __construct()
    {
        $this->client =         new Client();
    }

    abstract public function authorize();
}
