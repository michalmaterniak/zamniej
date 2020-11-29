<?php
namespace App\Application\Affiliations\Webepartners\Api\HotPrice;

use App\Application\Affiliations\Interfaces\Offers\FinderOffersInterface;
use App\Application\Affiliations\Webepartners\Api\Webepartners;

class HotPriceWebepartners extends Webepartners implements FinderOffersInterface
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetHotPrice';
    }

    /**
     * @return array
     */
    public function getHotPrice(int $programId)
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
        return $this->getHotPrice($idProgram);
    }
}
