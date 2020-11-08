<?php
namespace App\Application\Pages\Page\Types\Promotions\Factory;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\Factory\PageSubpageFactory;
use App\Application\Pages\Page\Factory\Slug\PageSlugGenerator;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PromotionsSubpageFactory
 * @package App\Application\Pages\Page\Types\Promotions\Factory
 */
class PromotionsSubpageFactory extends PageSubpageFactory
{
    public function __construct(
        EntityManagerInterface $entityManager,
        PageSlugGenerator $sluggable,
        Locale $locale
    ) {
        parent::__construct($entityManager, $sluggable, $locale);
    }
}
