<?php


namespace App\Application\Offers\Factory;

use App\Application\Offers\Factory\Interfaces\OffersFactoryInterface;
use App\Entity\Entities\Shops\Offers\Offers;

abstract class OfferAbstractFactory implements OffersFactoryInterface
{
    abstract public function getOfferEntity(): Offers;
}
