<?php

namespace App\Application\Affiliations\Convertiser\Programs;

use App\Application\Affiliations\AffiliationManager;
use App\Application\Affiliations\Convertiser\Api\TrackingUrlConvertiser;
use App\Application\Affiliations\ProgramsAffiliationFactory;
use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms;
use App\Entity\Entities\Affiliations\ShopsAffiliation;
use App\Repository\Repositories\Affiliations\Convertiser\ConvertiserProgramsRepository;
use App\Services\System\EntityServices\Updater\SimpleEntityUpdater;

class ProgramsConvertiserFactory extends ProgramsAffiliationFactory
{
    /**
     * @var ConvertiserProgramsRepository $convertiserProgramsRepository
     */
    protected $convertiserProgramsRepository;

    /**
     * @var ConvertiserPrograms|null $program
     */
    protected $program;

    /**
     * @var TrackingUrlConvertiser $trackingUrlConvertiser
     */
    protected $trackingUrlConvertiser;

    public function __construct(
        AffiliationManager $affiliationManager,
        SimpleEntityUpdater $entityUpdater,
        ConvertiserProgramsRepository $convertiserProgramsRepository,
        TrackingUrlConvertiser $trackingUrlConvertiser
    )
    {
        parent::__construct($affiliationManager, $entityUpdater);
        $this->convertiserProgramsRepository = $convertiserProgramsRepository;
        $this->trackingUrlConvertiser = $trackingUrlConvertiser;
    }

    /**
     * @param array $data
     * @param ConvertiserPrograms|null $program
     * @return ConvertiserPrograms|null
     */
    public function updateProgram(array $data, ConvertiserPrograms $program = null): ?ConvertiserPrograms
    {
        $this->program = $program ?: $this->convertiserProgramsRepository->select(false)->getProgramByAfiliationExternal($data['id'])->getResultOrNull();

        if (!$this->program) {
            $this->createProgram();
            $trackingUrl = $this->trackingUrlConvertiser->getTrackingUrl(
                $data['id'],
                $this->program->getAffiliation()->getData('website')
            );

            if ($trackingUrl) {
                $this->program->setTrackingUrl($trackingUrl);
            } else {
                return null;
            }
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
        return new ConvertiserPrograms();
    }

    protected function getAffiliationName(): string
    {
        return 'convertiser';
    }
}
