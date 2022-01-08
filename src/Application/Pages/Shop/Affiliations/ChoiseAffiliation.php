<?php
namespace App\Application\Pages\Shop\Affiliations;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use Doctrine\Common\Collections\ArrayCollection;

class ChoiseAffiliation
{
    /**
     * @var ArrayCollection|ShopsAffiliation[] $affiliations
     */
    protected $affiliations;

    /**
     * @var ShopsAffiliation $selectedShopAffiliation
     */
    protected $selectedShopAffiliation = null;

    /**
     * @param ArrayCollection|ShopsAffiliation[] $affiliations
     */
    public function loadAffiliations($affiliations)
    {
        $this->affiliations = $affiliations;
        foreach ($this->affiliations as $affiliation) {
            if ($affiliation->isForceActive()) {
                $this->selectedShopAffiliation = $affiliation;
            }
        }

        if ($this->selectedShopAffiliation === null) {
            $this->selectedShopAffiliation = $this->affiliations->filter(function (ShopsAffiliation $shopAffiliation) {
                return $shopAffiliation->isEnable();
            })->first();
        }
    }

    /**
     * @param ShopsAffiliation $shopToAnalyze
     */
    protected function byCps($shopToAnalyze)
    {
        return $this->selectedShopAffiliation->getCps() < $shopToAnalyze->getCps();
    }

    /**
     * @param ShopsAffiliation $shopToAnalyze
     */
    protected function byCpc($shopToAnalyze)
    {
        return $this->selectedShopAffiliation->getCpc() < $shopToAnalyze->getCpc();
    }
    protected function analyzeAffiliations()
    {
        if ($this->affiliations->count() > 1 && !$this->selectedShopAffiliation->isForceActive()) {

            foreach ($this->affiliations as $shopAffiliation) {
                if (!$shopAffiliation->isEnable()) {
                    continue;
                }

                if ($this->selectedShopAffiliation->getCpc() > 0) {
                    if ($this->byCpc($shopAffiliation)) {
                        $this->selectedShopAffiliation = $shopAffiliation;
                    }
                } elseif ($this->byCps($shopAffiliation)) {
                    $this->selectedShopAffiliation = $shopAffiliation;
                }
            }
        }
    }

    public function getShopAffiliation() : ShopsAffiliation
    {
        $this->analyzeAffiliations();

        return $this->selectedShopAffiliation;
    }
}
