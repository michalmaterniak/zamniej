<?php
namespace App\Repository\Repositories\Subpages;

use App\Entity\Entities\Subpages\Resources as Entity;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Repositories\Subpages\Pages\ShopRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use App\Services\Pages\Resource\ResourceConfig;
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
abstract class CustomResourceRepository extends ResourcesRepository
{
    /**
     * @var ResourceConfig $resourceConfig
     */
    protected $resourceConfig;

    protected function getEntityName(): string
    {
        return Entity::class;
    }

    public function __construct(
        ResourceConfig $resourceConfig,
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $servicesRepositoriesManager);
        $this->resourceConfig = $resourceConfig;
    }

    /**
     * @param int $type
     * @param bool $cache
     * @return $this
     */
    public function select(bool $cache = true): self
    {
        parent::select($cache);
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.resourceType = :type")->setParameter('type', $this->resourceConfig->getKey());
        return $this;
    }
}
