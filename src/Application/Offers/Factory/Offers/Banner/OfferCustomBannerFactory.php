<?php

namespace App\Application\Offers\Factory\Offers\Banner;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Shops\Offers\OffersBanner;

/**
 * Class OfferCustomBannerFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersBanner create() : Offers
 */
class OfferCustomBannerFactory extends OfferFactory
{
    /**
     * @var OffersBanner $offer
     */
    protected $offer;

    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersBanner();
    }
}
