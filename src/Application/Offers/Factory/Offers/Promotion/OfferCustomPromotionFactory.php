<?php
namespace App\Application\Offers\Factory\Offers\Promotion;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\OffersPromotion;

/**
 * Class OfferCustomPromotionFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersPromotion create(OfferInterface $offer) : Offers
 */
class OfferCustomPromotionFactory extends OfferFactory
{
    /**
     * @var OffersPromotion $offer
     */
    protected $offer;

    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersPromotion();
    }
}
