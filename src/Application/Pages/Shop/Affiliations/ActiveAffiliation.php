<?php

namespace App\Application\Pages\Shop\Affiliations;

use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface as EntityManager;

class ActiveAffiliation
{

    /**
     * @var ShopsAffiliation[]|ArrayCollection $affiliations
     */
    protected $affiliations;

    public function __construct(
        protected ShopsAffiliationRepository $shopsAffiliationRepository,
        protected EntityManager $entityManager
    )
    { }

    protected function disactiveAffiliations()
    {
        foreach ($this->affiliations as $affiliation) {
            $affiliation->setEnable(true);
        }
    }

    protected function activeAffiliations()
    {
        foreach ($this->affiliations as $affiliation) {
            $affiliation->setForceActive(true);
        }
    }

    public function setActivityAffiliations(bool $active, Subpages $shopSubpage)
    {
        $this->affiliations = $this->shopsAffiliationRepository->select()->findBySubpage($shopSubpage)->getResults();

        if ($active) {
            $this->activeAffiliations();
        } else {
            $this->disactiveAffiliations();
        }

        $this->entityManager->flush();
    }

}
