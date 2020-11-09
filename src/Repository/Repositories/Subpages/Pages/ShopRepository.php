<?php
namespace App\Repository\Repositories\Subpages\Pages;

use App\Application\Pages\Shop\ShopConfig;
use App\Repository\Repositories\Subpages\CustomResourceRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class ShopRepository extends CustomResourceRepository
{
    public function __construct(ShopConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function searchSubpagesByName(string $name): self
    {
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->queryBuilder->andWhere("{$aliasRootSubpages}.name = :name")->setParameter('name', "%{$name}%");
        return $this;
    }

    /**
     * @return $this
     */
    public function listingCategory(): self
    {
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->addLeftJoin('files', $aliasRootSubpages);
        return $this;
    }

    /**
     * @return $this
     */
    public function letterRequest(): self
    {
        $this->getServicesRepositoriesManager()->getShopsLetterRequestModifierQuery()->modify($this->queryBuilder);
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->addLeftJoin('files', $aliasRootSubpages);
        $this->addLeftJoin('content');
        $this->addLeftJoin('content', $aliasRootSubpages);
        return $this;
    }

    /**
     * @param int $max
     * @return $this
     */
    public function getLatest(int $max): self
    {
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->addLeftJoin('files', $aliasRootSubpages);

        $this->queryBuilder->setMaxResults($max)->orderBy("{$this->getRootAlias()}.idResource", "DESC");
        return $this;
    }
}
