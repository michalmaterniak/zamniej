<?php
namespace App\Repository\Repositories\Affiliations\Webepartners;

use App\Entity\Entities\Affiliations\Webepartners\WebepartnersPrograms as Entity;
use App\Repository\Repositories\Affiliations\ShopsAffiliationRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entity       find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null  findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]     findAllResult()
 * @method Entity[]     findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class WebepartnersProgramsRepository extends ShopsAffiliationRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }

    public function __construct(
        ManagerRegistry                 $registry,
        ServicesRepositoriesManager     $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @return ArrayCollection|Entity[]
     */
    public function getEnableProgramsIndexByProgramAffiliation()
    {
        $programs = $this->select()->getEnablePrograms()->getResults();

        $programsIndexByProgramAffiliation = new ArrayCollection();
        foreach ($programs as $program) {
            $programsIndexByProgramAffiliation->set($program->getId(), $program);
        }

        return $programsIndexByProgramAffiliation;
    }

    /**
     * @param int $programId
     * @return $this
     */
    public function getProgramByWebeId(int $programId): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.programId = :programId")
            ->setParameter('programId', $programId);
        return $this;
    }
}
