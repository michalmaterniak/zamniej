<?php
namespace App\Application\Offers\Factory;

use App\Application\Offers\Factory\Offers\OfferBannerFactory;
use App\Application\Offers\Factory\Offers\OfferProductFactory;
use App\Application\Offers\Factory\Offers\OfferPromotionFactory;
use App\Application\Offers\Factory\Offers\OfferVoucherFactory;
use App\Entity\Entities\Affiliations\Interfaces\OfferBannerInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferProductInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferPromotionInterface;
use App\Entity\Entities\Affiliations\Interfaces\OfferVoucherInterface;
use App\Entity\Entities\Shops\Offers\Offers;

class OfferFactoryManager
{
    /**
     * @var OfferFactory $offerVoucherFactory
     */
    protected $offerFactory;
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
        OfferFactory            $offerFactory,
        OfferVoucherFactory     $offerVoucherFactory,
        OfferBannerFactory      $offerBannerFactory,
        OfferProductFactory     $offerProductFactory,
        OfferPromotionFactory   $offerPromotionFactory
    ) {
        $this->offerFactory =           $offerFactory;
        $this->offerVoucherFactory =    $offerVoucherFactory;
        $this->offerBannerFactory =     $offerBannerFactory;
        $this->offerProductFactory =    $offerProductFactory;
        $this->offerPromotionFactory =  $offerPromotionFactory;
    }

    /**
     * @param OfferInterface $offer
     * @return Offers|\App\Entity\Entities\Shops\Offers\OffersBanner|\App\Entity\Entities\Shops\Offers\OffersProduct|\App\Entity\Entities\Shops\Offers\OffersPromotion|\App\Entity\Entities\Shops\Offers\OffersVoucher
     */
    public function create(OfferInterface $offer) : Offers
    {
        return $this->getFactory($offer)->create($offer);
    }

    /**
     * @param OfferInterface $offer
     * @return OfferFactory|OfferBannerFactory|OfferProductFactory|OfferPromotionFactory|OfferVoucherFactory
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
            return $this->offerFactory;
        }
    }
}
