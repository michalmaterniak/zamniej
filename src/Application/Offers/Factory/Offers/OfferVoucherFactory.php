<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferVoucherInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersVoucher;

class OfferVoucherFactory extends OfferFactory
{
    /**
     * @param OfferInterface|OfferVoucherInterface $offer
     */
    public function create(OfferInterface $offer) : OffersVoucher
    {
        $newOfferEntity = new OffersVoucher();

        $this->update($newOfferEntity, $offer, false);

        $this->entityManager->persist($newOfferEntity);

        $offer->setOffer($newOfferEntity);

        $this->entityManager->flush();

        $this->createPhoto($newOfferEntity, $offer);

        return $newOfferEntity;
    }

    /**
     * @param Offers|OffersVoucher                 $offerEntity
     * @param OfferInterface|OfferVoucherInterface $offer
     * @param bool                                 $withFlush
     */
    public function update(Offers $offerEntity, OfferInterface $offer, bool $withFlush = true)
    {
        $offerEntity->setCode($offer->getCode());
        parent::update($offerEntity, $offer, $withFlush);
    }
}
