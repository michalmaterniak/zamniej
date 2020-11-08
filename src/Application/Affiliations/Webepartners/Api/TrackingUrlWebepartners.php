<?php
namespace App\Application\Affiliations\Webepartners\Api;

use GuzzleHttp\Exception\RequestException;

class TrackingUrlWebepartners extends Webepartners
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/CreateTrackingUrl';
    }

    protected function getResponse(array $query = [])
    {
        $response = null;
        try {
            $response = $this->getClient()->get($this->getUrl(), [
                'query' => $query,
            ]);
        } catch (RequestException $requestException) {
            $response = $requestException->getResponse();
        }

        return $response->getBody()->getContents();
    }

    public function getTrackingUrl(string $url)
    {
        return $this->getResponse([
            'url' => $url,
        ]);
    }
}
