<?php
namespace App\Repository\Repositories\Subpages;

use App\Entity\Entities\Subpages\Resources;
use App\Repository\Repositories\GlobalRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

abstract class PageResourceRepository extends GlobalRepository
{

    public function __construct(
        ManagerRegistry $registry,
        ServicesRepositoriesManager $servicesRepositoriesManager
    ) {
        parent::__construct($registry, $servicesRepositoriesManager);
    }

    abstract public function withRelations() : self;

    public function byResource(Resources $resource) : self
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.resource = :resource")->setParameter('resource', $resource);
        return $this;
    }
}
