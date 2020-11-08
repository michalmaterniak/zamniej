<?php
namespace App\Repository\Repositories\Subpages\Pages\Types\Blog;

use App\Application\Pages\Page\Types\Blog\Articles\BlogArticlesConfig;
use App\Repository\Repositories\Subpages\Pages\PageRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class BlogArticlesRepository extends PageRepository
{
    public function __construct(BlogArticlesConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }
}
