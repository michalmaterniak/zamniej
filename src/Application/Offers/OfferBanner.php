<?php
namespace App\Application\Offers;

class OfferBanner extends Offer
{
    public function getTypeOffer(): string
    {
        return 'banner';
    }
}
