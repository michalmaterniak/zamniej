<?php
namespace App\Repository\Repositories\Affiliations;


use App\Entity\Entities\Affiliations\ShopsAffiliation as Entity;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entity                           find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null                      findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                         findAllResult()
 * @method Entity[]                         findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class ShopsAffiliationRepository extends GlobalRepository
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
     * @return $this
     */
    public function getNewPrograms()
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()}.isNew = 1")
        ;
        return $this;
    }

    /**
     * @return $this
     */
    public function getActivePrograms()
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()}.isNew = 0 AND {$this->getRootAlias()}.subpage IS NOT NULL ")
        ;

        return $this;
    }

    /**
     * @return $this
     */
    public function getUnactivePrograms()
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.isNew = 0 AND {$this->getRootAlias()}.subpage IS NULL ")
        ;
        return $this;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function getProgramById(int $id)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idShop = :id")
            ->setParameter('id', $id);
        $this->addLeftJoin('affiliation');
        return $this;
    }

    /**
     * @return $this
     */
    public function getEnablePrograms()
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.enable = 1");

        return $this;
    }

    /**
     * @param int $webeProgramId
     * @return $this
     */
    public function getProgramByWebeId(int $webeProgramId)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.programId = :programId")
            ->setParameter('programId', $webeProgramId);
        return $this;
    }
}
