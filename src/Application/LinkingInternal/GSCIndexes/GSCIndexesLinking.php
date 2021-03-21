<?php

namespace App\Application\LinkingInternal\GSCIndexes;

use App\Entity\Entities\GSC\GSCIndexes;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\GSC\GSCIndexesRepository;
use Doctrine\Common\Collections\ArrayCollection;

class GSCIndexesLinking
{
    /**
     * @var GSCIndexesRepository $gscIndexesRepository
     */
    protected $gscIndexesRepository;

    /**
     * @var int $countGscIndexesLinks
     */
    protected $countGscIndexesLinks;

    public function __construct(GSCIndexesRepository $gscIndexesRepository, int $countGscIndexesLinks = 6)
    {
        $this->gscIndexesRepository = $gscIndexesRepository;
        $this->countGscIndexesLinks = $countGscIndexesLinks;
    }

    /**
     * @return ArrayCollection|Subpages[]
     */
    public function getLastGSCIndexesSubpages()
    {
        $subpages = new ArrayCollection();
        foreach ($this->getLastGSCIndexes() as $gscIndex) {
            $subpages->add($gscIndex->getSubpage());
        }

        return $subpages;
    }

    /**
     * @return GSCIndexes[]|ArrayCollection
     */
    public function getLastGSCIndexes()
    {
        return $this->gscIndexesRepository->select()->lastNotUsed(
            $this->countGscIndexesLinks
        )->getResults();
    }
}
