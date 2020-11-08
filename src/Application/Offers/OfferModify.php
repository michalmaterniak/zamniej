<?php
namespace App\Application\Offers;

use App\Application\Offers\Offer\OfferLiker;

class OfferModify
{
    /**
     * @var OfferLiker $offerLiker
     */
    protected $offerLiker;
    public function __construct(OfferLiker $offerLiker)
    {
        $this->offerLiker = $offerLiker;
    }

    /**
     * @var Offer $offer
     */
    protected $offer;
    public function createModel(Offer $offer)
    {
        $model = clone $this;
        $model->setOffer($offer);

        return $model;
    }

    public function setOffer(Offer $offer)
    {
        $this->offer = $offer;
    }
}
