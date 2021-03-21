<?php

namespace App\Repository\Repositories\GSC;

use App\Entity\Entities\GSC\GSCIndexes;
use App\Entity\Entities\GSC\GSCIndexes as Entity;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
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
class GSCIndexesRepository extends GlobalRepository
{
    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    )
    {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    protected function getEntityName(): string
    {
        return Entity::class;
    }

    /**
     * @param int $count
     * @return static
     */
    public function lastShopNotUsed(int $count): self
    {
        $this->queryBuilder
            ->setMaxResults($count)
            ->addOrderBy("{$this->getRootAlias()}.datetime", Criteria::ASC)
            ->addOrderBy("{$this->getRootAlias()}.url", Criteria::ASC)
            ->andWhere("{$this->getRootAlias()}.used = 0");
        $leftSubpages = $this->addLeftJoin("subpage");
        $leftResources = $this->addLeftJoin("resource", $leftSubpages);
        $this->queryBuilder->andWhere("{$leftResources}.resourceType = 7");

        return $this;
    }

    /**
     * @param ArrayCollection|GSCIndexes[] $subpages
     * @return static
     */
    public function subpages($subpages): self
    {
        $this->queryBuilder
            ->andWhere("{$this->getRootAlias()}.subpage IN (:subpages)")
            ->setParameter('subpages', $subpages);
        $this->addLeftJoin("subpage");
        return $this;
    }
}
