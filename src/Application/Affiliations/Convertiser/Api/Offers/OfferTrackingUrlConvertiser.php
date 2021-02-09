<?php

namespace App\Application\Affiliations\Convertiser\Api\Offers;

use App\Application\Affiliations\Convertiser\Api\Convertiser;
use GuzzleHttp\Exception\RequestException;

class OfferTrackingUrlConvertiser extends Convertiser
{
    public function getOfferTrackingUrl(string $id, string $website, string $deepLink = null)
    {
        $data = ['id' => $id, 'website' => $website];

        if ($deepLink) {
            $data['deep_link'] = $deepLink;
        }

        return $this->getResponse($data);
    }

    protected function getResponse(array $data = [])
    {
        $response = null;
        try {
            $response = $this->getClient()->put(sprintf($this->getUrl(), $data['id']), [
                'json' => [
                    'website' => $data['website'],
                    'shorten' => true
                ]
            ]);
        } catch (RequestException $requestException) {
            $response = $requestException->getResponse();
        }

        $return = json_decode($response->getBody()->getContents(), true) ?: [];
        return $return['tracking_link'] ?? null;
    }

    protected function getUrl(): string
    {
        return '/publisher/coupons/%s/tracking_link/';
    }
}
