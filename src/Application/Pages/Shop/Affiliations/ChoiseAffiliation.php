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
    protected $selectedShopAffiliation;

    /**
     * @param ArrayCollection|ShopsAffiliation[] $affiliations
     */
    public function loadAffiliations($affiliations)
    {
        $this->affiliations = $affiliations;
        $this->selectedShopAffiliation = $this->affiliations->first();
    }

    /**
     * @param ShopsAffiliation $shopToAnalyze
     */
    protected function byCps($shopToAnalyze)
    {
        return $this->selectedShopAffiliation->getCps() < $shopToAnalyze;
    }

    /**
     * @param ShopsAffiliation $shopToAnalyze
     */
    protected function byCpc($shopToAnalyze)
    {
        return $this->selectedShopAffiliation->getCpc() < $shopToAnalyze;
    }
    protected function analyzeAffiliations()
    {
        if ($this->affiliations->count() > 1) {
            foreach ($this->affiliations as $shopAffiliation) {
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
