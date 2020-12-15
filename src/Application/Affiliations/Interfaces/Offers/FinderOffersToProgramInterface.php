<?php
namespace App\Application\Affiliations\Interfaces\Offers;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;

interface FinderOffersToProgramInterface
{
    /**
     * @param ShopsAffiliation|WebepartnersPrograms $program
     */
    public function loadOffers(ShopsAffiliation $program): void;
}
