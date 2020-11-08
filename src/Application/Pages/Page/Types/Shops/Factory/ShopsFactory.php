<?php
namespace App\Application\Pages\Page\Types\Shops\Factory;

use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\Page\Types\Shops\ShopsConfig;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ShopsFactory
 * @package App\Application\Pages\Page\Types\Shops\Factory
 */
class ShopsFactory extends PageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        ShopsSubpageFactory $subpageFactory,
        ShopsConfig $resourceConfig,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
    }
}
