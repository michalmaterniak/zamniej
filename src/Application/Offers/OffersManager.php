<?php
namespace App\Application\Offers;

use App\Application\Offers\Types\OfferBanner;
use App\Application\Offers\Types\OfferProduct;
use App\Application\Offers\Types\OfferPromotion;
use App\Application\Offers\Types\OfferVoucher;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersBanner;
use App\Entity\Entities\Shops\Offers\OffersProduct;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;
use Doctrine\Common\Collections\ArrayCollection;

class OffersManager
{
    /**
     * @var Offer $offer
     */
    protected $offer;

    /**
     * @var OfferProduct $offerProductModel
     */
    protected $offerProductModel;

    /**
     * @var OfferVoucher $offerVoucherModel
     */
    protected $offerVoucherModel;

    /**
     * @var OfferBanner $offerBannerModel
     */
    protected $offerBannerModel;

    /**
     * @var OfferPromotion $offerPromotionModel
     */
    protected $offerPromotionModel;

    public function __construct(
        OfferProduct    $offerProduct,
        OfferVoucher    $offerVoucher,
        OfferBanner     $offerBanner,
        OfferPromotion  $offerPromotion
    ) {
        $this->offerProductModel =      $offerProduct;
        $this->offerBannerModel =       $offerBanner;
        $this->offerVoucherModel =      $offerVoucher;
        $this->offerPromotionModel =    $offerPromotion;
    }

    /**
     * @param Offers[]|ArrayCollection $offers
     * @return ArrayCollection|Offer[]
     */
    public function createModelsOffers($offers)
    {
        $offersModels = new ArrayCollection();
        foreach ($offers as $offer) {
            $offersModels->add($this->createModelOffer($offer));
        }

        return $offersModels;
    }

    /**
     * @param Offers $offer
     * @return OfferBanner|OfferProduct|OfferPromotion|OfferVoucher
     */
    public function createModelOffer(Offers $offer)
    {
        $model = null;


        if ($offer instanceof OffersVoucher) {
            $model = $this->offerVoucherModel;
        } elseif ($offer instanceof OffersBanner) {
            $model = $this->offerBannerModel;
        } elseif ($offer instanceof OffersPromotion) {
            $model = $this->offerPromotionModel;
        } elseif ($offer instanceof OffersProduct) {
            $model = $this->offerProductModel;
        } else {
            $model = $this->offerPromotionModel;
        }


        $modelNew = clone $model;
        $modelNew->setOffer($offer);

        return $modelNew;
    }
}
