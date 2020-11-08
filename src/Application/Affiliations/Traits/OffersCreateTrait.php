<?php


namespace App\Application\Affiliations\Traits;

use App\Application\Affiliations\Offer;
use App\Entity\Entities\Shops\Offers\Offers;
use Doctrine\Common\Collections\ArrayCollection;

trait OffersCreateTrait
{


    /**
     * @param ArrayCollection|Offers[] $offers
     */
    public function createModels($offers)
    {
        $offersModel = new ArrayCollection();
        foreach ($offers as $offer) {
            $offerModel = $this->createModel($offer);

            $offersModel->add($offerModel);
        }

        return $offersModel;
    }

    /**
     * @param Offers $offer
     * @return Offer
     */
    public function createModel(Offers $offer)
    {
        /**
         * @var Offer $offerModel
         */
        $offerModel = clone $this;
        $offerModel->setOffer($offer);

        return $offerModel;
    }
    abstract public function setOffer(Offers $offer): void;
}
