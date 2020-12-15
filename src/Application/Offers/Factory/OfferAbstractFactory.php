<?php
namespace App\Application\Offers\Factory;

abstract class OfferAbstractFactory
{
    abstract public function getNewOfferEntity(): void;
}
