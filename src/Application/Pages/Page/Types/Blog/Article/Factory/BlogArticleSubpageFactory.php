<?php
namespace App\Application\Pages\Page\Types\Blog\Article\Factory;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\Factory\PageSubpageFactory;
use App\Application\Pages\Page\Factory\Slug\PageSlugGenerator;
use App\Services\Pages\Resource\Factory\SubpageFactory;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BlogArticleSubpageFactory
 * @package App\Application\Pages\Page\Types\Blog\Article\Factory
 */
class BlogArticleSubpageFactory extends PageSubpageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        PageSlugGenerator $sluggable,
        Locale $locale
    ) {
        parent::__construct($entityManager, $sluggable, $locale);
    }
}
