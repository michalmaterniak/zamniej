<?php

namespace App\Application\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\Affiliations;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use Doctrine\ORM\NonUniqueResultException;

class ProgramsWebepartnersFactory
{
    /**
     * @var EntityUpdater $entityUpdater
     */
    protected $entityUpdater;

    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;

    /**
     * @var Affiliations $affiliation
     */
    protected $affiliation;

    /**
     * @var WebepartnersPrograms|null $program
     */
    protected $program;

    /**
     * @var AffiliationsRepository $affiliationsRepository
     */
    protected $affiliationsRepository;

    public function __construct(
        EntityUpdater $entityUpdater,
        WebepartnersProgramsRepository $webepartnersProgramsRepository,
        AffiliationsRepository $affiliationsRepository
    )
    {
        $this->entityUpdater = $entityUpdater;
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
        $this->affiliationsRepository = $affiliationsRepository;
    }

    /**
     * @param array $webeProgram
     * @return WebepartnersPrograms
     * @throws NonUniqueResultException
     */
    public function updateProgram(array $webeProgram): WebepartnersPrograms
    {
        $this->affiliation = $this->affiliationsRepository->select()->findOneByName('webepartners')->getResultOrNull();

        $this->program = $this->webepartnersProgramsRepository->select(false)->getProgramByWebeId($webeProgram['programId'])->getResultOrNull();

        if ($this->program == null) {
            $this->createProgram();
            $this->entityUpdater->setEntity($this->program);
            $this->entityUpdater->update($webeProgram);

        } else {
            $this->entityUpdater->update($webeProgram);
        }

        return $this->program;
    }

    protected function createProgram()
    {
        $this->program = new WebepartnersPrograms();
        $this->program->setAffiliation($this->affiliation);
    }
}
