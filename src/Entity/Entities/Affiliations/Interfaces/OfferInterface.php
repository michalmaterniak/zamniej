<?php
namespace App\Entity\Entities\Affiliations\Interfaces;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Shops\Offers\Offers;

interface OfferInterface
{
    /**
     * @return string
     */
    public function getTitle() : string;

    /**
     * @return string
     */
    public function getContent() : string;

    /**
     * @return \DateTime
     */
    public function getDatetimeFrom() : \DateTime;

    /**
     * @return \DateTime|null
     */
    public function getDatetimeTo() : ?\DateTime;

    /**
     * @return string
     */
    public function getUrlTracking() : string;

    /**
     * @return string
     */
    public function getUrlImage() : string;

    /**
     * @return ShopsAffiliation
     */
    public function getShopAffiliation() : ShopsAffiliation;

    /**
     * @return Offers|null
     */
    public function getOffer() : ?Offers;

    /**
     * @param Offers $offer
     */
    public function setOffer(Offers $offer) : void;
}
