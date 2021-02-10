<?php
namespace App\Repository\Repositories\Affiliations\Convertiser;

use App\Entity\Entities\Affiliations\Convertiser\ConvertiserPrograms as Entity;
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
class ConvertiserProgramsRepository extends ShopsAffiliationRepository
{
    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    )
    {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    /**
     * @param $id
     * @return $this
     */
    public function byId($id): self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.id = :id")->setParameter('id', $id);
        return $this;
    }

    public function byUrlProgram(string $url): self
    {
        dump($url);
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.previewUrl LIKE :url")->setParameter('url', "%{$url}%");

        return $this;
    }

    protected function getEntityName(): string
    {
        return Entity::class;
    }
}
