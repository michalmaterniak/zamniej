<?php
namespace App\Entity\Entities\Affiliations\Interfaces;

interface OfferVoucherInterface extends OfferInterface
{
    /**
     * @return string
     */
    public function getCode() : string;
}
