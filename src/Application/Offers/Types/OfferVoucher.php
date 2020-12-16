<?php
namespace App\Application\Offers\Types;

use App\Application\Offers\Offer;

class OfferVoucher extends Offer
{
    public function getTypeOffer(): string
    {
        return 'voucher';
    }
}
