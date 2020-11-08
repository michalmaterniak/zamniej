<?php
namespace App\Repository\Repositories\Subpages\Pages;

use App\Application\Pages\Page\PageConfig;
use App\Repository\Repositories\Subpages\CustomResourceRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

abstract class PageRepository extends CustomResourceRepository
{
    public function __construct(PageConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }
}
