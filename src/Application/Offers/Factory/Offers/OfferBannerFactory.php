<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferBannerInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersBanner;

class OfferBannerFactory extends OfferFactory
{
    /**
     * @param OfferInterface|OfferBannerInterface $offer
     */
    public function create(OfferInterface $offer) : OffersBanner
    {
        $newOfferEntity = new OffersBanner();
        $this->update($newOfferEntity, $offer, false);

        $this->entityManager->persist($newOfferEntity);

        $offer->setOffer($newOfferEntity);

        $this->entityManager->flush();
        $this->createPhoto($newOfferEntity, $offer);

        return $newOfferEntity;
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
