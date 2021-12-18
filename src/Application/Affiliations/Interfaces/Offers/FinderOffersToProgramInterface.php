<?php
namespace App\Application\Affiliations\Interfaces\Offers;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;

interface FinderOffersToProgramInterface
{
    /**
     * @param ShopsAffiliation $program
     */
    public function loadOffers(ShopsAffiliation $program): void;
}
