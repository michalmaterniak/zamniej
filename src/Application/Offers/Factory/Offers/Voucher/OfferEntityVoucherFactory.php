<?php

namespace App\Application\Offers\Factory\Offers\Voucher;

use App\Application\Offers\Factory\OfferEntityFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersVoucher;

/**
 * Class OfferEntityVoucherFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersVoucher create(OfferInterface $offer) : Offers
 */
class OfferEntityVoucherFactory extends OfferEntityFactory
{
    /**
     * @var OffersVoucher $offer
     */
    protected $offer;

    /**
     * @return Offers|OffersVoucher
     */
    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersVoucher();
    }

    /**
     * @param OfferInterface $sourceOffer
     * @param Offers|null $offerEntity
     */
    public function updateByEntity(OfferInterface $sourceOffer, Offers $offerEntity = null)
    {
        $this->offer = $offerEntity ?: $this->offer;
        $this->offer->setCode($sourceOffer->getCode());
        parent::updateByEntity($sourceOffer, $offerEntity);
    }
}
