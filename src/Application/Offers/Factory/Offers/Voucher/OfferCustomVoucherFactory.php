<?php

namespace App\Application\Offers\Factory\Offers\Voucher;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersVoucher;

/**
 * Class OfferCustomVoucherFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersVoucher create(OfferInterface $offer) : Offers
 */
class OfferCustomVoucherFactory extends OfferFactory
{
    /**
     * @var OffersVoucher $offer
     */
    protected $offer;

    /**
     * @return Offers|OffersVoucher
     */
    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersVoucher();
    }
}
