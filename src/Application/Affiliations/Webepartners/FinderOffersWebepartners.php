<?php
namespace App\Application\Affiliations\Webepartners;

use App\Application\Affiliations\Interfaces\Offers\FinderOffersToProgramInterface;
use App\Application\Affiliations\Webepartners\Offers\OffersBannersWebepartnersFactory;
use App\Application\Affiliations\Webepartners\Offers\OffersHotsPriceWebepartnersFactory;
use App\Application\Affiliations\Webepartners\Offers\OffersPromotionsWebepartnersFactory;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;

class FinderOffersWebepartners implements FinderOffersToProgramInterface
{
    /**
     * @var OffersPromotionsWebepartnersFactory $offersPromotionsWebepartnersFactory
     */
    protected $offersPromotionsWebepartnersFactory;

    /**
     * @var OffersBannersWebepartnersFactory $offersBannersWebepartnersFactory
     */
    protected $offersBannersWebepartnersFactory;

    /**
     * @var OffersHotsPriceWebepartnersFactory $offersHotsPriceWebepartnersFactory
     */
    protected $offersHotsPriceWebepartnersFactory;

    public function __construct(
        OffersPromotionsWebepartnersFactory $offersPromotionsWebepartnersFactory,
        OffersBannersWebepartnersFactory $offersBannersWebepartnersFactory,
        OffersHotsPriceWebepartnersFactory $offersHotsPriceWebepartnersFactory
    )
    {

        $this->offersPromotionsWebepartnersFactory = $offersPromotionsWebepartnersFactory;
        $this->offersBannersWebepartnersFactory = $offersBannersWebepartnersFactory;
        $this->offersHotsPriceWebepartnersFactory = $offersHotsPriceWebepartnersFactory;
    }

    /**
     * @param ShopsAffiliation|WebepartnersPrograms $program
     */
    public function loadOffers(ShopsAffiliation $program): void
    {
        if ($program->isEnable() && $program->hasSubpage()) {
            $this->offersPromotionsWebepartnersFactory->findOffers($program);
            $this->offersBannersWebepartnersFactory->findOffers($program);
//        $this->offersHotsPriceWebepartnersFactory->findOffers($program);
        }
    }
}
