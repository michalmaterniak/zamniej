<?php

namespace App\Application\Affiliations;

use App\Entity\Entities\Affiliations\Affiliations;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
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
     * @var AffiliationsRepository $affiliationsRepository
     */
    protected $affiliationsRepository;


    public function __construct(
        AffiliationsRepository $affiliationsRepository,
        SimpleEntityUpdater $entityUpdater
    )
    {
        $this->affiliationsRepository = $affiliationsRepository;
        $this->entityUpdater = $entityUpdater;
    }

    /**
     * @return ShopsAffiliation
     */
    public function createProgram(): ShopsAffiliation
    {
        $this->program = $this->getEntityProgram();
        $this->program->setAffiliation($this->getAffiliation());
        $this->isPersist = true;
        return $this->program;
    }

    /**
     * @return ShopsAffiliation
     */
    abstract protected function getEntityProgram(): ShopsAffiliation;

    /**
     * @return Affiliations
     */
    protected function getAffiliation(): Affiliations
    {
        if (!$this->affiliation) {
            $this->affiliation = $this->affiliationsRepository->select()->findOneByName(
                $this->getAffiliationName()
            )->getResultOrNull();

        }
        return $this->affiliation;
    }

    abstract protected function getAffiliationName(): string;
}
