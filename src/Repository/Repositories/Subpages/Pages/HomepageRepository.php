<?php
namespace App\Repository\Repositories\Subpages\Pages;

use App\Application\Pages\Homepage\HomepageConfig;
use App\Repository\Repositories\Subpages\CustomResourceRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class HomepageRepository extends CustomResourceRepository
{
    public function __construct(HomepageConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }

    /**
     * @return $this
     */
    public function findHomepage() : self
    {
        return $this;
    }
}
