<?php
namespace App\Application\Affiliations\Webepartners\Api\HotPrice;

use App\Application\Affiliations\Webepartners\Api\Webepartners;

class HotPriceWebepartners extends Webepartners
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
}
