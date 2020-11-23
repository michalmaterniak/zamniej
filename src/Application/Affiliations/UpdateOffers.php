<?php
namespace App\Application\Affiliations;

use App\Application\Affiliations\Interfaces\FinderOffersInterface;
use App\Application\Affiliations\Webepartners\FinderOffersWebepartners;
use App\Entity\Entities\Affiliations\ShopsAffiliation;

class UpdateOffers
{
    /**
     * @var FinderOffersInterface[] $findersOffers
     */
    protected $findersOffers;

    public function __construct(FinderOffersWebepartners $finderOffersWebepartners)
    {
        $this->findersOffers['webepartners'] = $finderOffersWebepartners;
    }

    public function loadOffers(ShopsAffiliation $shopsAffiliation)
    {
        if (isset($this->findersOffers[$shopsAffiliation->getAffiliation()->getName()])) {
            $this->findersOffers[$shopsAffiliation->getAffiliation()->getName()]->loadOffers($shopsAffiliation);
        }
    }
}
