<?php
namespace App\Repository\Repositories\Affiliations;

use App\Entity\Entities\Affiliations\Affiliations as Entity;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entity               find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null          findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]             findAllResult()
 * @method Entity[]             findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class AffiliationsRepository extends GlobalRepository
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
     * @param string $name
     * @return $this
     */
    public function findOneByName(string $name)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.name = :name")
            ->setParameter('name', $name);

        return $this;
    }
}
