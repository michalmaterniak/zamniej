<?php
namespace App\Application\Pages\Page\Types\Categories\Factory;

use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\Page\Types\Categories\CategoriesConfig;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoriesFactory
 * @package App\Application\Pages\Page\Types\Categories\Factory
 */
class CategoriesFactory extends PageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        CategoriesSubpageFactory $subpageFactory,
        CategoriesConfig $resourceConfig,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
    }
}
