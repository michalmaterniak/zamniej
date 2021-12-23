<?php

namespace App\Application\LinkingInternal\GSCIndexes;

use Doctrine\ORM\EntityManagerInterface;

class GSCIndexesUpdater
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var GSCIndexesLinking $gscIndexesLinking
     */
    protected $gscIndexesLinking;

    public function __construct(
        GSCIndexesLinking $gscIndexesLinking,
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
        $this->gscIndexesLinking = $gscIndexesLinking;
    }

    public function update()
    {
        foreach ($this->gscIndexesLinking->getLastGSCIndexes() as $gscIndex) {
            $gscIndex->useOne();
        }

        $this->entityManager->flush();
    }
}
