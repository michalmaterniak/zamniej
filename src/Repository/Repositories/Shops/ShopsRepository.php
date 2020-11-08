<?php
namespace App\Repository\Repositories\Shops;

use App\Entity\Entities\Shops\Shops as Entity;
use App\Repository\Repositories\Subpages\PageResourceRepository;
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
class ShopsRepository extends PageResourceRepository
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
    public function withRelations(): self
    {
        $aliasRootTag = $this->addLeftJoin('tag');
        $this->addLeftJoin('tags', $aliasRootTag);
        return $this;
    }

    /**
     * @param int $priority
     * @param int $count
     * @return $this
     */
    public function lastPopular(int $priority = 2, int $count = 5): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.priority > :priority")->setParameter('priority', $priority);
        $aliasRootTag = $this->addLeftJoin('tag');
        $this->addLeftJoin('tags', $aliasRootTag);

        $aliasRootResource = $this->addLeftJoin('resource');
        $this->addLeftJoin('subpages', $aliasRootResource);
        return $this;
    }

}
