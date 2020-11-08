<?php
namespace App\Application\Pages\Homepage\Factory;

use App\Application\Pages\Homepage\Factory\Slug\HomepageSlugGenerator;
use App\Services\Pages\Resource\Factory\SubpageFactory;
use App\Application\Locale\Locale;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class HomepageSubpageFactory
 * @package App\Application\Pages\Homepage\Factory
 */
class HomepageSubpageFactory extends SubpageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        HomepageSlugGenerator $sluggable,
        Locale $locale
    ) {
        parent::__construct($entityManager, $sluggable, $locale);
    }
}
