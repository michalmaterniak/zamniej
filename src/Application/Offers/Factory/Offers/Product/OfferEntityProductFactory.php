<?php
namespace App\Application\Offers\Factory\Offers\Product;

use App\Application\Offers\Factory\OfferEntityFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersProduct;

/**
 * Class OfferEntityProductFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersProduct create(OfferInterface $offer) : Offers
 */
class OfferEntityProductFactory extends OfferEntityFactory
{
    /**
     * @var OffersProduct $offer
     */
    protected $offer;

    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersProduct();
    }

    /**
     * @param OfferInterface $offer
     * @param Offers|OffersProduct|null $offerEntity
     */
    public function updateByEntity(OfferInterface $offer, Offers $offerEntity = null)
    {
        $this->offer = $offerEntity ?: $this->offer;
        $this->offer->setPrice($offer->getCurrentPrice());
        $this->offer->setCutPrice($offer->getCutPrice());
        parent::updateByEntity($offer, $offerEntity);
    }
}
