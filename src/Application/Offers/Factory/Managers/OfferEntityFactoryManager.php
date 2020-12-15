<?php
namespace App\Application\Offers\Factory\Managers;

use App\Application\Offers\Factory\OfferEntityFactory;
use App\Application\Offers\Factory\Offers\Banner\OfferEntityBannerFactory as OfferBannerFactory;
use App\Application\Offers\Factory\Offers\Product\OfferEntityProductFactory as OfferProductFactory;
use App\Application\Offers\Factory\Offers\Promotion\OfferEntityPromotionFactory as OfferPromotionFactory;
use App\Application\Offers\Factory\Offers\Voucher\OfferEntityVoucherFactory as OfferVoucherFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferBannerInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferProductInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferVoucherInterface;
use App\Entity\Entities\Shops\Offers\Offers;
use App\Entity\Entities\Shops\Offers\OffersBanner;
use App\Entity\Entities\Shops\Offers\OffersProduct;
use App\Entity\Entities\Shops\Offers\OffersPromotion;
use App\Entity\Entities\Shops\Offers\OffersVoucher;

class OfferEntityFactoryManager
{
    /**
     * @var OfferEntityFactory $offerVoucherFactory
     */
    protected $OfferEntityFactory;

    /**
     * @var OfferVoucherFactory $offerVoucherFactory
     */
    protected $offerVoucherFactory;

    /**
     * @var OfferBannerFactory $offerBannerFactory
     */
    protected $offerBannerFactory;

    /**
     * @var OfferProductFactory $offerProductFactory
     */
    protected $offerProductFactory;

    /**
     * @var OfferPromotionFactory $offerPromotionFactory
     */
    protected $offerPromotionFactory;

    public function __construct(
        OfferEntityFactory $OfferEntityFactory,
        OfferVoucherFactory $offerVoucherFactory,
        OfferBannerFactory $offerBannerFactory,
        OfferProductFactory $offerProductFactory,
        OfferPromotionFactory $offerPromotionFactory
    ) {
        $this->OfferEntityFactory = $OfferEntityFactory;
        $this->offerVoucherFactory = $offerVoucherFactory;
        $this->offerBannerFactory =     $offerBannerFactory;
        $this->offerProductFactory =    $offerProductFactory;
        $this->offerPromotionFactory =  $offerPromotionFactory;
    }

    /**
     * @param OfferInterface $offer
     * @return Offers|OffersBanner|OffersProduct|OffersPromotion|OffersVoucher
     */
    public function create(OfferInterface $offer) : Offers
    {
        return $this->getFactory($offer)->create($offer);
    }

    /**
     * @param OfferInterface $offer
     * @return OfferEntityFactory|OfferBannerFactory|OfferProductFactory|OfferPromotionFactory|OfferVoucherFactory
     */
    protected function getFactory(OfferInterface $offer)
    {
        if ($offer instanceof OfferBannerInterface) {
            return $this->offerBannerFactory;
        } elseif ($offer instanceof OfferProductInterface) {
            return $this->offerProductFactory;
        } elseif ($offer instanceof OfferVoucherInterface) {
            return $this->offerVoucherFactory;
        } elseif ($offer instanceof OfferPromotionInterface) {
            return $this->offerPromotionFactory;
        } else {
            return $this->OfferEntityFactory;
        }
    }
}
