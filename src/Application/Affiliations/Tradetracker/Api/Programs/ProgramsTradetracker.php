<?php

namespace App\Application\Affiliations\Tradetracker\Api\Programs;

use App\Application\Affiliations\Tradetracker\Api\Tradetracker;
use Doctrine\Common\Collections\ArrayCollection;

class ProgramsTradetracker extends Tradetracker
{
    protected $currentCampaign;

    public function getPrograms() : ArrayCollection
    {
        $this->objects = new ArrayCollection();

        foreach ($this->tradetracker['affiliateSiteIDs'] as $affiliateSiteID) {
            foreach ($this->tradetrackerAuthorization->getSoap()->getCampaigns($affiliateSiteID, ['assignmentStatus' => 'accepted']) as $campaign) {
                $this->currentCampaign = $this->serializer->normalize($campaign);
                $this->reorganize();
                $this->objects->add($this->currentCampaign);
            }
        }

        return $this->objects;
    }

    protected function reorganize()
    {
        $info = $this->currentCampaign['info'];
        $commissions = $info['commission'];
        unset($info['commission']);
        unset($this->currentCampaign['info']);
        $this->currentCampaign = array_replace(
            $this->currentCampaign,
            $info,
            $commissions
        );
        $this->currentCampaign['id'] = $this->currentCampaign['ID'];

        unset($this->currentCampaign['ID']);
    }

}
