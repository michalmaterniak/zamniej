<?php
namespace App\Application\Offers\Factory\Offers\Banner;

use App\Application\Offers\Factory\OfferEntityFactory;
use App\Application\Offers\Factory\Traits\OfferPhotoUrlTrait;
use App\Entity\Entities\Affiliations\Interfaces\OfferBannerInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersBanner;

/**
 * Class OfferEntityBannerFactory
 * @package App\Application\Offers\Factory\Offers
 * @method OffersBanner create(OfferInterface $offer) : Offers
 */
class OfferEntityBannerFactory extends OfferEntityFactory
{
    use OfferPhotoUrlTrait;
    /**
     * @var OffersBanner $offer
     */
    protected $offer;

    public function getNewOfferEntity(): void
    {
        $this->offer = new OffersBanner();
    }

    /**
     * @param OfferInterface|OfferBannerInterface $offer
     * @param Offers|OffersBanner|null $offerEntity
     */
    public function updateByEntity(OfferInterface $offer, Offers $offerEntity = null)
    {
        parent::updateByEntity($offer, $offerEntity);
    }

    protected function createPhoto(array $data = []): void
    {
        $this->createPhotoByUrl($data['url']);
    }
}
