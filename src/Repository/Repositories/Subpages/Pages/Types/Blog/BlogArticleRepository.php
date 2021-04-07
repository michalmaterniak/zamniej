<?php
namespace App\Repository\Repositories\Subpages\Pages\Types\Blog;

use App\Application\Pages\Page\Types\Blog\Article\BlogArticleConfig;
use App\Repository\Repositories\Subpages\Pages\PageRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;
use ErrorException;

class BlogArticleRepository extends PageRepository
{
    public function __construct(BlogArticleConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }

    /**
     * @param int $max
     * @return $this
     * @throws ErrorException
     */
    public function findAllPerPageMax(int $max = 10): self
    {
        $this->getServicesRepositoriesManager()->getPaginationRequestModifierQuery()->modify($this->queryBuilder, $max);
        $aliasRootSubpages = $this->addLeftJoin('subpages');
        $this->addLeftJoin('files', $aliasRootSubpages);
        $this->addLeftJoin('content', $aliasRootSubpages);

        $this->queryBuilder->orderBy("{$aliasRootSubpages}.datetimeCreate", "DESC");

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
        $this->addLeftJoin('content', $aliasRootSubpages);

        $this->queryBuilder->setMaxResults($max)->orderBy("{$this->getRootAlias()}.idResource", "DESC");
        $this->queryBuilder->orderBy("{$aliasRootSubpages}.datetimeCreate", "DESC");
        return $this;
    }

}
