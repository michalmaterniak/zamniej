<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferVoucherInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use ErrorException;

/**
 * Class OfferVoucherFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersVoucher create(OfferInterface $offer) : Offers
 */
class OfferVoucherFactory extends OfferFactory
{
    public function getOfferEntity(): Offers
    {
        return new OffersVoucher();
    }

    /**
     * @param Offers|OffersVoucher $offerEntity
     * @param OfferInterface|OfferVoucherInterface $offer
     * @param bool $withFlush
     */
    public function update(Offers $offerEntity, OfferInterface $offer, bool $withFlush = true)
    {
        $offerEntity->setCode($offer->getCode());
        parent::update($offerEntity, $offer, $withFlush);
    }

    /**
     * @param Offers $offerEntity
     * @param OfferInterface $offer
     * @throws ErrorException
     */
    public function createPhoto(Offers $offerEntity, OfferInterface $offer)
    {
        $this->setPhotoBySubpage($offerEntity, $offer);
    }
}
