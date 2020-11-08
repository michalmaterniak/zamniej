<?php
namespace App\Repository\Repositories\Pages;

use App\Entity\Entities\Pages\Pages as Entity;
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
class PagesRepository extends PageResourceRepository
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
     * @return $this
     */
    public function withRelations(): self
    {
        return $this;
    }
}
