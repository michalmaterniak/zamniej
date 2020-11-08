<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersPromotion;

/**
 * Class OfferPromotionFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersPromotion create(OfferInterface $offer) : Offers
 */
class OfferPromotionFactory extends OfferFactory
{
    public function getOfferEntity(): Offers
    {
        return new OffersPromotion();
    }

    /**
     * @param Offers|OffersPromotion                 $offerEntity
     * @param OfferInterface|OfferPromotionInterface $offer
     * @param bool                                   $withFlush
     */
    public function update(Offers $offerEntity, OfferInterface $offer, bool $withFlush = true)
    {
        parent::update($offerEntity, $offer, $withFlush);
    }
}
