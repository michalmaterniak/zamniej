<?php
namespace App\Application\Offers;

class OfferProduct extends Offer
{
    public function getTypeOffer(): string
    {
        return 'product';
    }
}
