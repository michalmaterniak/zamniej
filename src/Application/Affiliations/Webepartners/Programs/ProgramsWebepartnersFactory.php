<?php
namespace App\Application\Affiliations\Webepartners\Programs;

use App\Entity\Entities\Affiliations\Affiliations;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Services\System\EntityServices\Updater\EntityUpdater;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;

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
        SimpleEntityUpdater $entityUpdater,
        WebepartnersProgramsRepository $webepartnersProgramsRepository,
        AffiliationsRepository $affiliationsRepository
    )
    {
        $this->entityUpdater = $entityUpdater;
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
        $this->affiliationsRepository = $affiliationsRepository;
    }

    /**
     * @return Affiliations
     */
    protected function getAffiliation(): Affiliations
    {
        if (!$this->affiliation) {
            $this->affiliation = $this->affiliationsRepository->select()->findOneByName('webepartners')->getResultOrNull();

        }
        return $this->affiliation;
    }

    /**
     * @param array $data
     * @param WebepartnersPrograms|null $program
     * @return WebepartnersPrograms
     */
    public function updateProgram(array $data, WebepartnersPrograms $program = null): WebepartnersPrograms
    {
        $this->program = $program ?: $this->webepartnersProgramsRepository->select(false)->getProgramByWebeId($data['programId'])->getResultOrNull();

        if (!$this->program) {
            $this->createProgram();
        }
        $this->entityUpdater->setEntity($this->program);

        $this->entityUpdater->update($data);

        $this->entityUpdater->flush();
        return $this->program;
    }

    /**
     * @return ShopsAffiliation
     */
    public function createProgram(): ShopsAffiliation
    {
        $this->program = new WebepartnersPrograms();
        $this->program->setAffiliation($this->getAffiliation());
        return $this->program;
    }
}
