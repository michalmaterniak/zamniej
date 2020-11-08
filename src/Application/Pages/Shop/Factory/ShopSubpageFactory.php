<?php
namespace App\Application\Pages\Shop\Factory;

use App\Application\Pages\Shop\Factory\Slug\SlugShopGenerator;
use App\Services\Pages\Resource\Factory\Slug\Interfaces\Sluggable;
use App\Services\Pages\Resource\Factory\SubpageFactory;
use App\Services\System\Locale\Interfaces\LocaleInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ShopSubpageFactory
 * @package App\Services\Subpages\Factory\Subpages
 */
class ShopSubpageFactory extends SubpageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        SlugShopGenerator $sluggable,
        LocaleInterface $locale
    ) {
        parent::__construct($entityManager, $sluggable, $locale);
    }
}
