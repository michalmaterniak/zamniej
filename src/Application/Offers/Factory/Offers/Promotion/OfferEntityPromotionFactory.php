<?php
namespace App\Application\Offers\Factory\Offers\Promotion;

use App\Application\Offers\Factory\OfferEntityFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersPromotion;

/**
 * Class OfferEntityPromotionFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersPromotion create(OfferInterface $offer) : Offers
 */
class OfferEntityPromotionFactory extends OfferEntityFactory
{
    /**
     * @var OffersPromotion $offer
     */
    protected $offer;

    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersPromotion();
    }

    /**
     * @param OfferInterface $sourceOffer
     * @param Offers|null $offerEntity
     */
    public function updateByEntity(OfferInterface $sourceOffer, Offers $offerEntity = null)
    {
        parent::updateByEntity($sourceOffer, $offerEntity);
    }
}
