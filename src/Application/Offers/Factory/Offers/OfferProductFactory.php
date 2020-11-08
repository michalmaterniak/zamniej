<?php
namespace App\Application\Offers\Factory\Offers;

use App\Application\Offers\Factory\OfferFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferProductInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersProduct;

/**
 * Class OfferProductFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersProduct create(OfferInterface $offer) : Offers
 */
class OfferProductFactory extends OfferFactory
{
    public function getOfferEntity(): Offers
    {
        return new OffersProduct();
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
