<?php

namespace App\Application\Affiliations\Tradetracker\Api;

use App\Application\Affiliations\AffiliationAutorizeInterface;

class TradetrackerAuthorization implements AffiliationAutorizeInterface
{
    /**
     * @var \SoapClient $soap
     */
    protected $soap;

    /**
     * @var array $tradetracker
     */
    protected $tradetracker;

    public function __construct(array $tradetracker)
    {
        $this->tradetracker = $tradetracker;
        $this->soap = new \SoapClient($this->tradetracker['wsdl'], array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
        $this->authorize();
    }

    public function authorize()
    {
        $this->soap->authenticate($this->tradetracker['customerId'], $this->tradetracker['passphrase']);
    }

    /**
     * @return array
     */
    public function getTradetracker(): array
    {
        return $this->tradetracker;
    }

    /**
     * @return \SoapClient
     */
    public function getSoap(): \SoapClient
    {
        return $this->soap;
    }

}
