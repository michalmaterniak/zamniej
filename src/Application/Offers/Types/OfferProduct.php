<?php
namespace App\Application\Offers\Types;

use App\Application\Offers\Offer;

class OfferProduct extends Offer
{
    public function getTypeOffer(): string
    {
        return 'product';
    }
}