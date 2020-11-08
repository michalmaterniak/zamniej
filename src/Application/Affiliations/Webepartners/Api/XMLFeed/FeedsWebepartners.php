<?php


namespace App\Application\Affiliations\Webepartners\Api\XMLFeed;

use App\Application\Affiliations\Webepartners\Api\WebepartersInterface;
use App\Application\Affiliations\Webepartners\Api\Webepartners;

class FeedsWebepartners extends Webepartners
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetFeeds';
    }

    public function getFeed(int $idProgram)
    {
        return $this->getResponse(['programId' => $idProgram]);
    }
}
