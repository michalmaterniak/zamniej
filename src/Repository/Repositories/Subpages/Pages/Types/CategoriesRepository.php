<?php
namespace App\Repository\Repositories\Subpages\Pages\Types;

use App\Application\Pages\Page\Types\Categories\CategoriesConfig;
use App\Repository\Repositories\Subpages\Pages\PageRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class CategoriesRepository extends PageRepository
{
    public function __construct(CategoriesConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }
}
