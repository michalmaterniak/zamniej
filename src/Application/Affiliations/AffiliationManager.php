<?php

namespace App\Application\Affiliations;

use App\Entity\Entities\Affiliations\Affiliations;
use App\Repository\Repositories\Affiliations\AffiliationsRepository;
use Doctrine\ORM\EntityManagerInterface;

class AffiliationManager
{
    /**
     * @var AffiliationsRepository $affiliationsRepository
     */
    protected $affiliationsRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
        $this->affiliationsRepository = $this->entityManager->getRepository(Affiliations::class);
    }

    public function getAffiliation(string $name, bool $createIfNotExist = true): ?Affiliations
    {
        $affiliation = $this->affiliationsRepository->select()->findOneByName($name)->getResultOrNull();

        if (!$affiliation && $createIfNotExist) {
            $affiliation = $this->createAffiliation($name);
        }

        return $affiliation;
    }

    public function createAffiliation(string $name): Affiliations
    {
        $method = 'create' . ucfirst($name);
        if (method_exists($this, $method)) {
            $affiliation = $this->$method($name);
        } else {
            $affiliation = $this->createDefaultAffiliation($name);
        }

        $this->entityManager->persist($affiliation);
        $this->entityManager->flush();
        return $affiliation;
    }

    private function createDefaultAffiliation($name): Affiliations
    {
        return new Affiliations($name);
    }

    private function createConvertiser(string $name): Affiliations
    {
        $affiliation = $this->createDefaultAffiliation($name);

        $affiliation->setData([
            'website' => '0pxEKW7z6b'
        ]);

        return $affiliation;
    }

}
