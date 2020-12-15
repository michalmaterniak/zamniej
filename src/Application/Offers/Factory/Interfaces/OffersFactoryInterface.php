<?php
namespace App\Application\Offers\Factory\Interfaces;

use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Shops\Offers\Offers;

interface OffersFactoryInterface
{
    public function createByEntity(OfferInterface $offer): Offers;
}
