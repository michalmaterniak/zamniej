<?php
namespace App\Application\Pages\Page\Types\Blog\Articles\Factory;

use App\Application\Pages\Page\Factory\PageFactory;
use App\Application\Pages\Page\Types\Blog\Articles\BlogArticlesConfig;
use App\Services\Subpages\SlugGenerator\SlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BlogArticlesFactory
 * @package App\Application\Pages\Page\Types\Blog\Articles\Factory
 */
class BlogArticlesFactory extends PageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        BlogArticlesSubpageFactory $subpageFactory,
        BlogArticlesConfig $resourceConfig,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct($entityManager, $subpageFactory, $resourceConfig, $slugGenerator);
    }
}
