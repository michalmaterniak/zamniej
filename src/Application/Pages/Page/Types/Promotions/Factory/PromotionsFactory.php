<?php
namespace App\Application\Pages\Page\Types\Promotions\Factory;

use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\Page\PageConfig;
use App\Application\Pages\Page\Types\Promotions\PromotionsConfig;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PromotionsFactory
 * @package App\Application\Pages\Page\Types\Promotions\Factory
 */
class PromotionsFactory extends PageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        PromotionsSubpageFactory $subpageFactory,
        PromotionsConfig $resourceConfig,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
    }
}
