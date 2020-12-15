<?php
namespace App\Application\Offers\Factory\Offers\Promotion;

use App\Application\Offers\Factory\OfferEntityFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Types\OffersPromotion;

/**
 * Class OfferCustomPromotionFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersPromotion create(OfferInterface $offer) : Offers
 */
class OfferCustomPromotionFactory extends OfferEntityFactory
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
