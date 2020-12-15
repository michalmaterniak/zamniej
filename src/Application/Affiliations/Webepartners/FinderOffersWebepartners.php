<?php
namespace App\Application\Affiliations\Webepartners;

use App\Application\Affiliations\Interfaces\Offers\FinderOffersToProgramInterface;
use App\Application\Affiliations\Webepartners\Offers\OffersBannersWebepartnersFactory;
use App\Application\Affiliations\Webepartners\Offers\OffersHotsPriceWebepartnersFactory;
use App\Application\Affiliations\Webepartners\Offers\OffersPromotionsWebepartnersFactory;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;

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

    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    public function __construct(
        WebepartnersProgramsRepository $webepartnersProgramsRepository,

        OffersPromotionsWebepartnersFactory $offersPromotionsWebepartnersFactory,
        OffersBannersWebepartnersFactory $offersBannersWebepartnersFactory,
        OffersHotsPriceWebepartnersFactory $offersHotsPriceWebepartnersFactory
    )
    {
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;

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
