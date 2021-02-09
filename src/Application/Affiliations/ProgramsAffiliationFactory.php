<?php

namespace App\Application\Affiliations;

use App\Entity\Entities\Affiliations\Affiliations;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;

abstract class ProgramsAffiliationFactory
{
    protected $isPersist = false;

    /**
     * @var EntityUpdater $entityUpdater
     */
    protected $entityUpdater;

    /**
     * @var Affiliations $affiliation
     */
    protected $affiliation;

    /**
     * @var ShopsAffiliation|null $program
     */
    protected $program;

    /**
     * @var AffiliationManager $affiliationManager
     */
    protected $affiliationManager;

    public function __construct(
        AffiliationManager $affiliationManager,
        SimpleEntityUpdater $entityUpdater
    )
    {
        $this->entityUpdater = $entityUpdater;
        $this->affiliationManager = $affiliationManager;
    }

    /**
     * @return ShopsAffiliation
     */
    public function createProgram(): ShopsAffiliation
    {
        $this->program = $this->getEntityProgram();
        $this->program->setAffiliation($this->affiliationManager->getAffiliation(
            $this->getAffiliationName()
        ));

        $this->isPersist = true;
        return $this->program;
    }

    /**
     * @return ShopsAffiliation
     */
    abstract protected function getEntityProgram(): ShopsAffiliation;

    abstract protected function getAffiliationName(): string;
}
