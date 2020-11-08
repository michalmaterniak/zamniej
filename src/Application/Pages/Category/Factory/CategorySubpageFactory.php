<?php
namespace App\Application\Pages\Category\Factory;

use App\Application\Pages\Category\Factory\Slug\SlugCategoryGenerator;
use App\Services\Pages\Resource\Factory\SubpageFactory;
use App\Application\Locale\Locale;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CreateCategorySubpage
 * @package App\Services\Subpages\Factory\Subpages
 */
class CategorySubpageFactory extends SubpageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        SlugCategoryGenerator $sluggable,
        Locale $locale
    ) {
        parent::__construct($entityManager, $sluggable, $locale);
    }
}
