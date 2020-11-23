<?php

namespace App\Application\Affiliations\Interfaces;

use App\Entity\Entities\Affiliations\ShopsAffiliation;

interface FinderOffersInterface
{
    public function loadOffers(ShopsAffiliation $program);
}
