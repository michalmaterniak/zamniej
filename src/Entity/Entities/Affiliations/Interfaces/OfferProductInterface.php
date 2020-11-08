<?php
namespace App\Entity\Entities\Affiliations\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

interface OfferProductInterface extends OfferInterface
{
    /**
     * @return float
     */
    public function getCurrentPrice() : float;

    /**
     * @return float
     */
    public function getCutPrice() : float;

    /**
     * @return float
     */
    public function getPercentDeal() : float;

    /**
     * @return ArrayCollection|
     */
    public function getHistoryPrices() : ArrayCollection;
}
