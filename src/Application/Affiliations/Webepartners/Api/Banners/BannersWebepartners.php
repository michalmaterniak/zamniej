<?php
namespace App\Application\Affiliations\Webepartners\Api\Banners;

use App\Application\Affiliations\Interfaces\Offers\FinderOffersInterface;
use App\Application\Affiliations\Webepartners\Api\Webepartners;

class BannersWebepartners extends Webepartners implements FinderOffersInterface
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetBanners';
    }

    /**
     * @return array
     */
    public function getBanners(int $programId)
    {
        return $this->getResponse([
            'programId' => $programId,
        ]);
    }

    /**
     * @param int $idProgram
     */
    public function getOffers($idProgram)
    {
        return $this->getBanners($idProgram);
    }
}
