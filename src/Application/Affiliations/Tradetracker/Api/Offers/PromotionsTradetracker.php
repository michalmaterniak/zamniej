<?php

namespace App\Application\Affiliations\Tradetracker\Api\Offers;

use App\Application\Affiliations\Tradetracker\Api\Tradetracker;
use Doctrine\Common\Collections\ArrayCollection;

class PromotionsTradetracker extends Tradetracker
{
    protected $currentPromotion;

    protected function setPromotions() {

    }

    public function getPromotions() : ArrayCollection
    {
        $this->objects = new ArrayCollection();

        foreach ($this->tradetracker['affiliateSiteIDs'] as $affiliateSiteID) {
            foreach ($this->getMaterialIncentiveItems($affiliateSiteID) as $campaign) {
                $this->currentPromotion = $this->serializer->normalize($campaign);
                $this->reorganize();
                $this->objects->add($this->currentPromotion);
            }
        }

        return $this->objects;
    }

    protected function getMaterialIncentiveItems(int $affiliateSiteID) {
        return $this->tradetrackerAuthorization->getSoap()->getMaterialIncentiveOfferItems($affiliateSiteID, 'html', []);
    }

    protected function reorganize()
    {
        $campaign = $this->currentPromotion['campaign'];
        unset($this->currentPromotion['campaign']);
        $this->currentPromotion['campaignId'] = $campaign['ID'];
        $this->currentPromotion['id'] = $this->currentPromotion['ID'];
        $this->currentPromotion['campaignName'] = $campaign['name'];
        unset($this->currentPromotion['ID']);

        $output_array = [];

        preg_match('/a href="(.*)" target/', $this->currentPromotion['code'], $output_array);

        if (isset($output_array[1])) {
            $this->currentPromotion['urlTracking'] = $output_array[1];
        } else {
            $this->currentPromotion['urlTracking'] = '';
        }

        $output_array = [];

        preg_match('/<img src="(.*)" alt/', $this->currentPromotion['code'], $output_array);

        if (isset($output_array[1])) {
            $this->currentPromotion['urlImage'] = $output_array[1];
        } else {
            $this->currentPromotion['urlImage'] = '';
        }
    }

}
