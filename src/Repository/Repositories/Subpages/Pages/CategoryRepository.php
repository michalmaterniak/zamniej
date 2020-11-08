<?php
namespace App\Repository\Repositories\Subpages\Pages;

use App\Application\Pages\Category\CategoryConfig;
use App\Repository\Repositories\Subpages\CustomResourceRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends CustomResourceRepository
{
    public function __construct(CategoryConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }

    public function searchCategoryByText(string $partName)
    {
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->queryBuilder->andWhere("{$aliasRootSubpages}.name LIKE :name")
            ->setParameter('name', "%$partName%");
        return $this;
    }

    /**
     * @return $this
     */
    public function listingCategories(): self
    {
        $this->addLeftJoin('subpages');
        $this->addLeftJoin('files');
        return $this;
    }

    /**
     * @return $this
     */
    public function footerLinks(): self
    {
        $this->queryBuilder->setMaxResults('7');
        $this->addLeftJoin('subpages');
        $this->queryBuilder->orderBy("{$this->getRootAlias()}.countChildren", "DESC");
        return $this;
    }
}
