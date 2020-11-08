<?php
namespace App\Application\Offers;

class OfferPromotion extends Offer
{
    public function getTypeOffer(): string
    {
        return 'promotion';
    }
}
