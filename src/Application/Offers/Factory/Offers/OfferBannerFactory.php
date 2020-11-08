<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferBannerInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersBanner;

/**
 * Class OfferBannerFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersBanner create(OfferInterface $offer) : Offers
 */
class OfferBannerFactory extends OfferFactory
{
    public function getOfferEntity(): Offers
    {
        return new OffersBanner();
    }

    /**
     * @param Offers|OffersBanner                 $offerEntity
     * @param OfferInterface|OfferBannerInterface $offer
     * @param bool                                $withFlush
     */
    public function update(Offers $offerEntity, OfferInterface $offer, bool $withFlush = true)
    {
        parent::update($offerEntity, $offer, $withFlush);
    }
}
