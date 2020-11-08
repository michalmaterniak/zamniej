<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersPromotion;

class OfferPromotionFactory extends OfferFactory
{
    /**
     * @param OfferInterface|OfferPromotionInterface $offer
     */
    public function create(OfferInterface $offer) : OffersPromotion
    {
        $newOfferEntity = new OffersPromotion();

        $this->update($newOfferEntity, $offer, false);

        $this->entityManager->persist($newOfferEntity);

        $offer->setOffer($newOfferEntity);

        $this->entityManager->flush();

        $this->createPhoto($newOfferEntity, $offer);

        return $newOfferEntity;
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
