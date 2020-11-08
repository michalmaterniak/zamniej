<?php
namespace App\Application\Pages\Page\Factory;

use App\Application\Pages\Page\Factory\Slug\PageSlugGenerator;
use App\Services\Pages\Resource\Factory\SubpageFactory;
use App\Application\Locale\Locale;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PageSubpageFactory
 * @package App\Application\Pages\Page\Factory
 */
abstract class PageSubpageFactory extends SubpageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        PageSlugGenerator $sluggable,
        Locale $locale
    ) {
        parent::__construct($entityManager, $sluggable, $locale);
    }
}
