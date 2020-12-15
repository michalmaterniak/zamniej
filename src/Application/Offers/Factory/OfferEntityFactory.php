<?php

namespace App\Application\Offers\Factory;

use App\Application\Offers\Factory\Interfaces\OffersFactoryInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use ErrorException;
use Exception;

class OfferEntityFactory extends OfferFactory implements OffersFactoryInterface
{
    public function createByEntity(OfferInterface $offer): Offers
    {
        if ($offer->getShopAffiliation()->getSubpage() === null) {
            throw new ErrorException("Subpage have to be defined");
        }
        try {
            $this->entityUpdater->getEntityManager()->beginTransaction();
            $this->getNewOfferEntity();
            $this->updateByEntity($offer);
            $this->entityUpdater->getEntityManager()->persist($this->offer);
            $offer->setOffer($this->offer);
            $this->entityUpdater->getEntityManager()->flush();
            $this->createPhoto();
            $this->entityUpdater->getEntityManager()->commit();
        } catch (Exception $exception) {
            $this->entityUpdater->getEntityManager()->rollback();
        }
        return $this->offer;
    }

    /**
     * @param OfferInterface $sourceOffer
     * @param Offers|null $offerEntity
     */
    public function updateByEntity(OfferInterface $sourceOffer, Offers $offerEntity = null)
    {
        $this->offer = $offerEntity ?: $this->offer;
        $offerEntity->setShopAffiliation($sourceOffer->getShopAffiliation());
        $offerEntity->setSubpage($sourceOffer->getShopAffiliation()->getSubpage());
        $offerEntity->setContent(strip_tags($sourceOffer->getContent()));
        $offerEntity->setTitle($sourceOffer->getTitle());
        $offerEntity->setDatetimeFrom($sourceOffer->getDatetimeFrom());
        $offerEntity->setDatetimeTo($sourceOffer->getDatetimeTo());
        $offerEntity->setUrl($sourceOffer->getUrlTracking());
    }
}
