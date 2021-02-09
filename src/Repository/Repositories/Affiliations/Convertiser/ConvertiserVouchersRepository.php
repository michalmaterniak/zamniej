<?php

namespace App\Repository\Repositories\Affiliations\Convertiser;

use App\Entity\Entities\Affiliations\Convertiser\ConvertiserVouchers as Entity;
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
class ConvertiserVouchersRepository extends ShopsAffiliationRepository
{
    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    )
    {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @return $this
     */
    public function externalId(string $exteralId)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.id = :id")->setParameter('id', $exteralId);
        return $this;
    }

    protected function getEntityName(): string
    {
        return Entity::class;
    }
}
