<?php

namespace App\Application\Affiliations\Tradetracker\Programs;

use App\Application\Affiliations\AffiliationManager;
use App\Application\Affiliations\ProgramsAffiliationFactory;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Tradetracker\TradetrackerPrograms;
use App\Repository\Repositories\Affiliations\Tradetracker\TradetrackerProgramsRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;

class ProgramsTradetrackerFactory extends ProgramsAffiliationFactory
{

    /**
     * @var TradetrackerPrograms|null $program
     */
    protected $program;

    public function __construct(
        protected TradetrackerProgramsRepository $tradetrackerProgramsRepository,
        AffiliationManager $affiliationManager,
        SimpleEntityUpdater $entityUpdater
    )
    {
        parent::__construct($affiliationManager, $entityUpdater);
    }

    /**
     * @param array $data
     * @param TradetrackerPrograms|null $program
     * @return TradetrackerPrograms
     */
    public function updateProgram(array $data, TradetrackerPrograms $program = null): TradetrackerPrograms
    {
        $this->program = $program ?: $this->tradetrackerProgramsRepository->select(false)->getProgramByAfiliationExternal($data['id'])->getResultOrNull();

        if (!$this->program)
        {
            $this->createProgram();
        }
        $this->entityUpdater->setEntity($this->program);

        $this->entityUpdater->update($data);

        if ($this->isPersist) {
            $this->entityUpdater->persist($this->program);
        }

        $this->entityUpdater->flush();
        return $this->program;
    }

    protected function getEntityProgram(): ShopsAffiliation
    {
        return new TradetrackerPrograms();
    }

    protected function getAffiliationName(): string
    {
        return 'tradetracker';
    }
}
