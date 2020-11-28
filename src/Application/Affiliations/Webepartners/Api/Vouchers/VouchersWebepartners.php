<?php
namespace App\Application\Affiliations\Webepartners\Api\Vouchers;

use App\Application\Affiliations\Interfaces\Offers\FinderOffersInterface;
use App\Application\Affiliations\Webepartners\Api\Webepartners;
use DateTime;

class VouchersWebepartners extends Webepartners implements FinderOffersInterface
{
    /**
     * @var array $vouchers
     */
    protected $vouchers;

    protected function getUrl(): string
    {
        return 'https://api2.webepartners.pl/Wydawca/GetVouchers';
    }

    /**
     * @param DateTime $datetimeFrom
     * @param DateTime $datetimeTo
     * @return array|mixed
     */
    public function getVouchers(DateTime $datetimeFrom, DateTime $datetimeTo)
    {
        return $this->getResponse([
            'dateFrom' => $datetimeFrom->format('Y-m-d'),
            'dateTo' => $datetimeTo->format('Y-m-d'),
        ]);
    }

    /**
     * @param int $idProgram
     */
    public function getOffers($idProgram)
    {
        if (!$this->vouchers) {
            foreach ($this->getVouchers((new DateTime())->modify('-2 years'), (new DateTime())) as $voucher) {
                $this->vouchers[$voucher['programId']] = $voucher;
            }
        }
        return $this->vouchers[$idProgram];
    }
}
