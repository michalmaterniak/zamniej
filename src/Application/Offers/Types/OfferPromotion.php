<?php
namespace App\Application\Offers\Types;

use App\Application\Offers\Offer;

class OfferPromotion extends Offer
{
    public function getTypeOffer(): string
    {
        return 'promotion';
    }
}
