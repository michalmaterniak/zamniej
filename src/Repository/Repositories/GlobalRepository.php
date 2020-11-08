<?php
namespace App\Repository\Repositories;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Entities\Subpages\Subpages;
use App\Repository\Services\ServicesRepositoriesManager;
use App\Repository\Traits\RepositoryCacheTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * Class GlobalRepository
 * @package App\Repository\Repositories
 */
abstract class GlobalRepository extends ServiceEntityRepository
{
    /**
     * @var QueryBuilder $queryBuilder
     */
    protected $queryBuilder;

    /**
     * @var ServicesRepositoriesManager $servicesRepositoriesManager
     */
    private $servicesRepositoriesManager;

    use RepositoryCacheTrait;

    public function __construct(
        ManagerRegistry                 $registry,
        ServicesRepositoriesManager     $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $this->getEntityName());
        $this->servicesRepositoriesManager =    $servicesRepositoriesManager;
    }

    /**
     * @return ServicesRepositoriesManager
     */
    public function getServicesRepositoriesManager(): ServicesRepositoriesManager
    {
        return $this->servicesRepositoriesManager;
    }

    public static function getAlias(string $className)
    {
        $alias = $className;
        $alias = str_replace('App\Repository\Repositories\\', '', $alias);
        $alias = str_replace('App\Entity\Entities\\', '', $alias);
        $alias = strtolower($alias);
        $alias = str_replace('repository', '', $alias);
        $alias = str_replace('\\', '_', $alias);

        return $alias;
    }

    protected function getRootAlias() : string
    {
        return static::getAlias(get_class($this));
    }

    /**
     * @return int|mixed|string
     */
    public function getResults()
    {
        $query = $this->queryBuilder->getQuery();

        if ($this->cacheEnable()) {
            return $this->getCache($query, function (ItemInterface $item) use ($query) {
                return new ArrayCollection($query->getResult());
            });
        }

        return new ArrayCollection($query->getResult());
    }

    /**
     * @return int|mixed|string
     */
    public function getResultOrNull()
    {
        $query = $this->queryBuilder->getQuery();

        if ($this->cacheEnable()) {
            return $this->getCache($query, function (ItemInterface $item) use ($query) {
                return $query->getOneOrNullResult();
            });
        }
        return $query->getOneOrNullResult();
    }

    /**
     * @return Paginator|mixed
     */
    public function getPaginate()
    {
        $this->getServicesRepositoriesManager()->getPaginationRequestModifierQuery()->modify($this->queryBuilder);

        $query = $this->queryBuilder->getQuery();

        if ($this->cacheEnable()) {
            return $this->getCache($query, function (ItemInterface $item) use ($query) {
                return new Paginator($query);
            });
        }
        return new Paginator($query);
    }

    protected function start(bool $cache)
    {
        $this->getServicesRepositoriesManager()->getLeftJoinsModifierQuery()->clearLeftJoins();
        $this->setCacheEnable($cache);
        $this->queryBuilder = $this->getEntityManager()->createQueryBuilder();
    }

    /**
     * @param string $left
     * @param string|null $rootAlias
     * @return string
     */
    protected function addLeftJoin(string $left, string $rootAlias = null) : string
    {
        return $this->getServicesRepositoriesManager()->getLeftJoinsModifierQuery()->addLeftJoin($this->queryBuilder, $left, $rootAlias);
    }

    /**
     * @param bool $cache
     * @return $this
     * @throws MappingException
     */
    public function counting(bool $cache = true) : self
    {
        $this->start($cache);
        $meta = $this->getEntityManager()->getClassMetadata($this->getEntityName());
        $identifier = $meta->getSingleIdentifierFieldName();

        $this->queryBuilder
            ->select("count({$this->getRootAlias()}.{$identifier})")
            ->from($this->getEntityName(), $this->getRootAlias());

        return $this;
    }

    /**
     * @param bool $cache
     * @return static
     */
    public function select(bool $cache = false): self
    {
        $this->start($cache);
        $this->queryBuilder
            ->select($this->getRootAlias())
            ->from($this->getEntityName(), $this->getRootAlias());
        return $this;
    }

    /**
     * @param string|null $orderBy
     * @param string $ordering
     * @return $this
     */
    public function ordering(string $orderBy = null, string $ordering = 'ASC')
    {
        if($orderBy === null)
            $this->getServicesRepositoriesManager()->getOrderingRequestModifierQuery()->modify($this->queryBuilder);
        else
            $this->queryBuilder->orderBy($orderBy, $ordering);

        return $this;
    }

    /**
     * @return int
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getCount()
    {
        $query = $this->queryBuilder->getQuery();

        if ($this->cacheEnable()) {
            return $this->getCache($query, function (ItemInterface $item) {
                return new Paginator($this->queryBuilder);
            });
        }

        return $query->getSingleScalarResult();
    }

    public function bySubpage(Subpages $subpage)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.subpage = :subpage")->setParameter('subpage', $subpage);
        return $this;
    }

    public function byResource(Resources $resource)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.resource = :resource")->setParameter('resource', $resource);
        return $this;
    }

}
