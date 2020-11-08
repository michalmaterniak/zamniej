<?php
namespace App\Repository\Repositories\Subpages\Pages\Types;

use App\Application\Pages\Page\Types\Shops\ShopsConfig;
use App\Repository\Repositories\Subpages\Pages\PageRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class ShopsRepository extends PageRepository
{
    public function __construct(ShopsConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }
    /**
     * @param array $ids
     * @return $this
     */
    public function findByIds(array $ids)
    {
        $this->queryBuilder->andWhere("{$this->getRootAlias()}.idResource IN (:ids)")->setParameter('ids', $ids);

        $leftRootSubpages = $this->addLeftJoin('subpages');
        $this->addLeftJoin('files', $leftRootSubpages);

        $leftRootParents = $this->addLeftJoin('parents');
        $this->addLeftJoin('subpages', $leftRootParents);

        return $this;
    }

}
