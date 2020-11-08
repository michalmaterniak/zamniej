<?php
namespace App\Application\Pages\Page\Types\Categories;

use App\Application\Locale\Locale;
use App\Application\Pages\Page\PageSubpagesManager;
use App\Application\Pages\Page\Seo\PageSeo;

/**
 * Class CategoriesSubpagesManager
 * @package App\Application\Pages\Page\Types\Categories
 */
class CategoriesSubpagesManager extends PageSubpagesManager
{
    public function __construct(
        PageSeo $seo,
        CategoriesSubpage $subpageResource,
        Locale $locale
    ) {
        parent::__construct($seo, $subpageResource, $locale);
    }
}
