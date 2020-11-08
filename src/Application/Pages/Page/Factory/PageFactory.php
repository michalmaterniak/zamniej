<?php
namespace App\Application\Pages\Page\Factory;

use App\Application\Pages\Page\PageConfig;
use App\Services\Pages\Resource\Factory\ResourceFactory;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PageFactory
 * @package App\Application\Pages\Page\Factory
 */
abstract class PageFactory extends ResourceFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        PageSubpageFactory $subpageFactory,
        PageConfig $resourceConfig,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
    }
}
