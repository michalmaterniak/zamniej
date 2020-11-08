<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferProductInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersProduct;

class OfferProductFactory extends OfferFactory
{
    /**
     * @param OfferInterface|OfferProductInterface $offer
     */
    public function create(OfferInterface $offer) : OffersProduct
    {
        $newOfferEntity = new OffersProduct();

        $this->update($newOfferEntity, $offer, false);

        $this->entityManager->persist($newOfferEntity);

        $offer->setOffer($newOfferEntity);

        $this->entityManager->flush();
        $this->createPhoto($newOfferEntity, $offer);

        return $newOfferEntity;
    }

    /**
     * @param Offers|OffersProduct                 $offerEntity
     * @param OfferInterface|OfferProductInterface $offer
     * @param bool                                 $withFlush
     */
    public function update(Offers $offerEntity, OfferInterface $offer, bool $withFlush = true)
    {
        $offerEntity->setPrice($offer->getCurrentPrice());
        $offerEntity->setCutPrice($offer->getCutPrice());
        parent::update($offerEntity, $offer, $withFlush);
    }
}
