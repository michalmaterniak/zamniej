<?php

namespace App\Application\Affiliations\Convertiser\Api;

use GuzzleHttp\Exception\RequestException;

class TrackingUrlConvertiser extends Convertiser
{
    public function getTrackingUrl(string $id, string $website)
    {
        return $this->getResponse(['id' => $id, 'website' => $website]);
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
        return 'https://app.convertiser.com/api/publisher/offers/%s/tracking_link/';
    }
}
