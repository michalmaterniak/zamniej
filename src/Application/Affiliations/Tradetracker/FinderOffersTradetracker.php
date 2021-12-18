<?php

namespace App\Application\Affiliations\Tradetracker;

use App\Application\Affiliations\Interfaces\Offers\FinderOffersToProgramInterface;
use App\Application\Affiliations\Tradetracker\Offers\OffersPromotionsTradetrackerFactory;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPrograms;

class FinderOffersTradetracker implements FinderOffersToProgramInterface
{
    public function __construct(protected OffersPromotionsTradetrackerFactory $offersPromotionsTradetrackerFactory){}

    /**
     * @param ShopsAffiliation|TradetrackerPrograms $program
     */
    public function loadOffers(ShopsAffiliation $program): void
    {
        if ($program->isEnable() && $program->hasSubpage()) {
            $this->offersPromotionsTradetrackerFactory->findOffers($program);
        }
    }
}
