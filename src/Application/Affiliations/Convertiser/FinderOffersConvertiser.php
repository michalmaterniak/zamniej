<?php

namespace App\Application\Affiliations\Convertiser;

use App\Application\Affiliations\Convertiser\Offers\OffersPromotionsConvertiserFactory;
use App\Application\Affiliations\Interfaces\Offers\FinderOffersToProgramInterface;
use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms;
use App\Entity\Entities\Affiliations\ShopsAffiliation;

class FinderOffersConvertiser implements FinderOffersToProgramInterface
{
    /**
     * @var OffersPromotionsConvertiserFactory $offersPromotionsConvertiserFactory
     */
    protected $offersPromotionsConvertiserFactory;

    public function __construct(OffersPromotionsConvertiserFactory $offersPromotionsConvertiserFactory)
    {
        $this->offersPromotionsConvertiserFactory = $offersPromotionsConvertiserFactory;
    }

    /**
     * @param ShopsAffiliation|ConvertiserPrograms $program
     */
    public function loadOffers(ShopsAffiliation $program): void
    {
        if ($program->isEnable() && $program->hasSubpage()) {
            $this->offersPromotionsConvertiserFactory->findOffers($program);
        }
    }
}
