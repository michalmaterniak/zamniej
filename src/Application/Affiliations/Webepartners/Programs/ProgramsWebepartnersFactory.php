<?php
namespace App\Application\Affiliations\Webepartners\Programs;

use App\Application\Affiliations\ProgramsAffiliationFactory;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
use App\Repository\Repositories\Affiliations\Webepartners\WebepartnersProgramsRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;

class ProgramsWebepartnersFactory extends ProgramsAffiliationFactory
{
    /**
     * @var WebepartnersPrograms|null $program
     */
    protected $program;

    /**
     * @var WebepartnersProgramsRepository $webepartnersProgramsRepository
     */
    protected $webepartnersProgramsRepository;
    public function __construct(
        SimpleEntityUpdater $entityUpdater,
        WebepartnersProgramsRepository $webepartnersProgramsRepository,
        AffiliationsRepository $affiliationsRepository
    )
    {
        parent::__construct($affiliationsRepository, $entityUpdater);
        $this->entityUpdater = $entityUpdater;
        $this->webepartnersProgramsRepository = $webepartnersProgramsRepository;
    }

    protected function getEntityProgram(): ShopsAffiliation
    {
        return new WebepartnersPrograms();
    }

    protected function getAffiliationName(): string
    {
        return 'webepartners';
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
            $this->entityUpdater->persist($this->program);
        }
        $this->entityUpdater->setEntity($this->program);

        $this->entityUpdater->update($data);

        if ($this->isPersist) {
            $this->entityUpdater->persist($this->program);
            $this->isPersist = false;
        }

        $this->entityUpdater->flush();

        return $this->program;
    }
}
