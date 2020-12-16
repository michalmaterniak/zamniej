<?php
namespace App\Repository\Repositories\System\Files;

use App\Entity\Entities\System\Files;
use App\Entity\Entities\System\Files as Entity;
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
class PhotosRepository extends GlobalRepository
{
    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    )
    {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    public function byPath(string $path)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.path = :path")->setParameter('path', $path);
        return $this;
    }

    protected function getEntityName(): string
    {
        return Entity::class;
    }

    protected function qualifySelect()
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.type = :type")->setParameter('type', Files::PHOTO);
    }
}
