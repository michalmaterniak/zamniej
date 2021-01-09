<?php
namespace App\Repository\Repositories\Subpages;

use App\Entity\Entities\Subpages\Resources;
use App\Entity\Entities\Subpages\Resources as Entity;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use ErrorException;

/**
 * @method Entity                           find($id, $lockMode = null, $lockVersion = null)
 * @method Entity|null                      findOneBy(array $criteria, array $orderBy = null)
 * @method Entity[]                         findAllResult()
 * @method Entity[]                         findAll()
 * @method Entity[]|ArrayCollection getResults()
 * @method Entity|null              getResultOrNull()
 * @method Entity[]|Paginator       getPaginate()
 */
class ResourcesRepository extends GlobalRepository
{
    protected function getEntityName(): string
    {
        return Entity::class;
    }

    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    )
    {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @return $this
     * @throws ErrorException
     */
    public function getCurrentResource()
    {
        $this->getServicesRepositoriesManager()->getSlugRequestModifierQuery()->modify($this->queryBuilder);

        $aliasRootSubpages = $this->addLeftJoin('subpages');

        $aliasRootParents = $this->addLeftJoin('parents');

        $this->addLeftJoin('files');
        $this->addLeftJoin('content');
        $this->addLeftJoin('files', $aliasRootSubpages);
        $this->addLeftJoin('seo', $aliasRootSubpages);
        $this->addLeftJoin('content', $aliasRootSubpages);
        $this->addLeftJoin('subpages', $aliasRootParents);
        return $this;
    }

    /**
     * @param int $type
     * @param int|null $count
     * @return $this
     */
    public function findResourcesByType(int $type, int $count = null)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.resourceType = :type")->setParameter('type', $type);
        $this->addLeftJoin('subpages');

        if ($count)
            $this->queryBuilder->setMaxResults($count);

        return $this;
    }

    /**
     * @param int $idResource
     * @return $this
     */
    public function byIdResource(int $idResource): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idResource = :id")->setParameter('id', $idResource);
        return $this;
    }

    /**
     * @param Entity $parent
     * @return $this
     */
    public function getChildren(Resources $parent)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.parent = :parent")->setParameter('parent', $parent);
        return $this;
    }

    /**
     * @return $this
     */
    public function withChildren()
    {
        $this->addLeftJoin('children');
        return $this;
    }

    /**
     * @param int $parent
     * @return $this
     */
    public function withChildrenByParentId(int $parent)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idResource = :parent")->setParameter('parent', $parent);
        $this->withChildren();
        return $this;
    }

    /**
     * @return $this
     */
    public function withConfig(): self
    {
        $this->addLeftJoin('config');
        $this->addLeftJoin('subpages');
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function bySearchText(string $text): self
    {
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->queryBuilder->andWhere("{$aliasRootSubpages}.name LIKE :text")->setParameter('text', "%$text%");
        return $this;
    }

    /**
     * @param Entity $resource
     * @return $this
     */
    public function byParent(Resources $resource): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.parent = :parent")->setParameter('parent', $resource);
        return $this;
    }

    /**
     * @param Entity $resource
     * @return $this
     */
    public function active(): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.active = 1");
        return $this;
    }

    /**
     * @param Entity $resource
     * @return $this
     */
    public function inactive(): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.active = 0");
        return $this;
    }
}
