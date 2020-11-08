<?php
namespace App\Application\Affiliations\Webepartners\Api\Vouchers;

use App\Application\Affiliations\Webepartners\Api\Webepartners;

class VouchersWebepartners extends Webepartners
{
    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetVouchers';
    }

    /**
     * @param \DateTime $datetimeFrom
     * @param \DateTime $datetimeTo
     * @return array|mixed
     */
    public function getVouchers(\DateTime $datetimeFrom, \DateTime $datetimeTo)
    {
        return $this->getResponse([
            'dateFrom' => $datetimeFrom->format('Y-m-d'),
            'dateTo' => $datetimeTo->format('Y-m-d'),
        ]);
    }
}
