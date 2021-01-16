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
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.isNew = 1");
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
     * @param mixed $webeProgramId
     * @return $this
     */
    public function getProgramByAfiliationExternal($externalId)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.externalId = :externalId")
            ->setParameter('externalId', $externalId);
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutExternalId(): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.externalId IS NULL OR {$this->getRootAlias()}.externalId = ''");
        return $this;
    }

    public function bySubpage(Subpages $subpage)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.subpage = :subpage")->setParameter('subpage', $subpage);
        return $this;
    }

    /**
     * @param Subpages $subpage
     * @return $this
     */
    public function findBySubpage(Subpages $subpage): self
    {
        $this->addLeftJoin('affiliation');
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.subpage = :subpage")->setParameter('subpage', $subpage);
        return $this;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function byId(int $id)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idShop = :id")->setParameter('id', $id);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function byName(string $name)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.name = :name")->setParameter('name', $name);
        return $this;
    }
}
