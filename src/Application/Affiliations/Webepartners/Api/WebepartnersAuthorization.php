<?php
namespace App\Application\Affiliations\Webepartners\Api;

use App\Application\Affiliations\AffiliationAutorizeAbstract;
use GuzzleHttp\Client;

class WebepartnersAuthorization extends AffiliationAutorizeAbstract
{
    /**
     * @var array
     */
    private $webepartners;
    public function __construct(array $webepartners)
    {
        parent::__construct();
        $this->webepartners = $webepartners;
        $this->authorize();
    }

    public function authorize()
    {
        if (!$this->logged) {
            $this->client = new Client([
                'auth' => [
                    $this->webepartners['api_access']['login'],
                    $this->webepartners['api_access']['access'],
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
