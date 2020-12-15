<?php
namespace App\Application\Offers\Types;

use App\Application\Offers\Offer;

class OfferBanner extends Offer
{
    public function getTypeOffer(): string
    {
        return 'banner';
    }
}
