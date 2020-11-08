<?php
namespace App\Repository\Repositories\Subpages;

use App\Entity\Entities\Subpages\Subpages as Entity;
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
class SubpagesRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }
    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @param string $name
     * @return static
     */
    public function searchSubpagesByName(string $name) : self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.name LIKE :name AND {$this->getRootAlias()}.active = 1")
            ->setParameter('name', "%$name%");
        ;
        return $this;
    }
}
