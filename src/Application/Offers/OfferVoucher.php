<?php
namespace App\Application\Offers;

class OfferVoucher extends Offer
{
    public function getTypeOffer(): string
    {
        return 'voucher';
    }
}
