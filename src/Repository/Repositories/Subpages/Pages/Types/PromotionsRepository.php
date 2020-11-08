<?php
namespace App\Repository\Repositories\Subpages\Pages\Types;

use App\Application\Pages\Page\Types\Promotions\PromotionsConfig;
use App\Repository\Repositories\Subpages\Pages\PageRepository;
use App\Repository\Services\ServicesRepositoriesManager;
use Doctrine\Persistence\ManagerRegistry;

class PromotionsRepository extends PageRepository
{
    public function __construct(PromotionsConfig $resourceConfig, ManagerRegistry $registry, ServicesRepositoriesManager $servicesRepositoriesManager)
    {
        parent::__construct($resourceConfig, $registry, $servicesRepositoriesManager);
    }
}
